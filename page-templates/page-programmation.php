<?php

include ("token.php");

/*
Template Name: Page Programmation
*/
/**
 * Expands the home directory alias '~' to the full path.
 * @param string $path the path to expand.
 * @return string the expanded path.
 */

function getClient()
{
    try{
        $client = new \Google_Client();
        //$client->setClientId(GOOGLE_CLIENT_ID);
        //$client->setClientSecret(GOOGLE_CLIENT_SECRET);
        $client->setDeveloperKey(GOOGLE_API_KEY);
        $client->setRedirectUri(GOOGLE_REDIRECT_URL);
        $client->setScopes(GOOGLE_SCOPES);
        $client->setApprovalPrompt(GOOGLE_APPROVAL_PROMPT);
        $client->setAccessType(GOOGLE_ACCESS_TYPE);
    }
    catch (Google_Service_Exception $ge)
    {
        echo $ge->getMessage();
    }


    return $client;
}
$dateDeb=new DateTime();
$dateDeb->setTime(0,0,0);
$dateFin = new DateTime();
$dateFin->add(DateInterval::createFromDateString('15 day'));
$dateFin->setTime(0,0,0);

$client = getClient();
$service = new Google_Service_Calendar($client);


$calendarId=["tv8ulmfd66rvm0usr7mhjstogc@group.calendar.google.com"=>["logo"=>"accropodefault.png","class"=>"BuvetteAN"],//BuvetteAN
    "4089pseg009iqs6h2fap5vv9i4@group.calendar.google.com"=>["logo"=>"logo-directan.png","class"=>"directan"],//DirectAN
    "k2ovdv68mq92g4k3qk1fpdnft8@group.calendar.google.com"=>["logo"=>"accropodefault.png","class"=>"divers"],//Divers
    "mdtvulfob62hs8p77qhm90jnuo@group.calendar.google.com"=>["logo"=>"logo-leurope.png","class"=>"leurope"],//L'Europe l'Europe l'Europe
    "4f8asbgpflh0gneqb2oe3qaiqg@group.calendar.google.com"=>["logo"=>"logo-onu.png","class"=>"onu"],//La communauté de l'ONU
    "1ekodrv7a6he47n3g8hbf2ah5s@group.calendar.google.com"=>["logo"=>"logo-libreantenne.png","class"=>"libreantenne"],//La Libre Antenne
    "271665r41i0955is8n2c41i4is@group.calendar.google.com"=>["logo"=>"logo-ocanada.png","class"=>"ocanada"],//Ô Canada
    "jg8mvrv45tg05j9icb3qu1ttd4@group.calendar.google.com"=>["logo"=>"logo-directan.png","class"=>"qag"],];//QAG Commentées

$optParams = array(
    'orderBy' => 'startTime',
    'singleEvents' => TRUE,
    'timeMin' => $dateDeb->format('c'),
    'timeMax' => $dateFin->format('c'),
);
$results = array();
foreach ($calendarId as $id=>$value)
{
    try{
        $results[$id] = $service->events->listEvents($id, $optParams);
    }
    catch (Google_Service_Exception $ge)
    {
        echo $ge->getMessage();
    }
}

$listEvent = array();
foreach($results as $id=>$calendar) {
    foreach ($calendar->getItems() as $event)
    {
        $event->calendar=$id;
        $event->casters=array();
        $event->logo=get_template_directory_uri()."/assets/images/logos/".$calendarId[$id]["logo"];
        $event->class=$calendarId[$id]["class"];
        $listEvent[] = $event;
    }
}

usort ( $listEvent,"sortCalendar");
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

    <div id="page-programmation" role="main">

        <?php do_action( 'foundationpress_before_content' ); ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
                <header>
                    <h1 class="entry-title animated-title">
                        <div class="animated-title content__title__inner">
                            <?php the_title(); ?>
                        </div>
                    </h1>
                    <h3 class="cons-title">Page en construction</h3>
                </header>
                <?php
                $date= new DateTime();
                $date->setTime(0,0,0);
                $event = array_shift ($listEvent);
                $today=new DateTime();
                $todayWithTime=new DateTime();
                $today->setTime(0,0,0);
                for($i=0;$i<15;$i++)
                {
                    if($event!=null && $date->diff(new DateTime($event->start->dateTime))->format("%d")==0)
                    {

                        echo"<div class='programmation--emission-event ".($date->diff($today)->format("%d")==0?"programmation--emission-event-today":"")."'>";
                        $diff = $date->diff($today)->format("%d");
                        switch ($diff)
                        {
                            case 0:echo "<aside class='event-aside'>Aujourd'hui</aside>";break;
                            case 1:echo "<aside class='event-aside'>Demain</aside>";break;
                            default: echo"<aside class='event-aside'>dans ".$diff." jours</aside>";
                        }
                        echo "<div class='date' data-date='".$date->format("Ymd")."'></div>";
                        while($event!=null && $date->diff(new DateTime($event->start->dateTime))->format("%d")==0)
                            {
                                if(isset($event->attachments))
                                {
                                    foreach($event->attachments as $attachment)
                                    {
                                        $path=explode("-",$attachment->title);
                                        if($path[0] == "logo")
                                            $event->logo = "https://drive.google.com/uc?export=view&id=".$attachment->fileId;
                                        else if($path[0] == "caster")
                                        {
                                            $event->casters[] = "https://drive.google.com/uc?export=view&id=".$attachment->fileId;
                                        }
                                    }
                                }
                                $dateEventDeb=new DateTime($event->start->dateTime);
                                $dateEventFin=new DateTime($event->end->dateTime);
                                echo"<article class='event ".$event->class." ";
                                    if($todayWithTime->getTimestamp() > $dateEventDeb->getTimestamp() && $todayWithTime->getTimestamp() < $dateEventFin->getTimestamp())
                                        echo "now";
                                    else if($todayWithTime->getTimestamp() > $dateEventDeb->getTimestamp())
                                        echo "after";
                                    else
                                        echo "before";
                                echo "'>";

                                    echo"<div class='logo-colonne'>";
                                        //echo"<a href='https://calendar.google.com/calendar/ical/".urlencode($event->calendar)."/public/basic.ics' target='_blank'><i class='fa fa-calendar'></i></a>";
                                        echo"<div class='logo'> <img src='$event->logo'></div>";
                                    echo"</div>";
                                    echo"<div class='text-colonne'>";
                                    echo"<p class='horaire'>".$dateEventDeb->format("H:i")." - ".$dateEventFin->format("H:i")."</p>";
                                    echo"<h2>".$event->getSummary()."</h2>";
                                    echo"<div class='caster-colonne'>";
                                        foreach ($event->casters as $caster)
                                            echo"<div class='img-colonne'><div class='caster-wrapper'><img src='$caster'></div></div>";
                                    echo"</div>";
                                    echo"</div>";
                                    echo"<div class='button-colonne ".($todayWithTime->getTimestamp() > $dateEventDeb->getTimestamp() && $todayWithTime->getTimestamp() < $dateEventFin->getTimestamp() ? "live":"no-live")."'>";

                                        if($todayWithTime->getTimestamp() > $dateEventDeb->getTimestamp()-(15*60) && $todayWithTime->getTimestamp() < $dateEventFin->getTimestamp())
                                        {
                                            echo "<div class='live-now'>live en cours</div>";
                                            echo "<a class='button btn-Twitch' href='https://www.twitch.tv/accropolis' target='_blank'><img src='".get_template_directory_uri()."/assets/images/twitch.png'/></a>";
                                            echo "<a class='button btn-YouTube' href='https://www.youtube.com/laviepublique/live' target='_blank'><img src='".get_template_directory_uri()."/assets/images/youtube.png'/></a>";
                                        }
                                        else
                                        //bouton live en cours / twitch / youtub
                                            echo"<a href='".$event->htmlLink."' target='_blank'><i class='fa fa-calendar'></i></a>";

                                echo"</div>";
                                $event = array_shift($listEvent);
                                echo "</article>";
                            }
                        echo "</div>";
                    }
                    else
                        echo "<div class='programmation--emission-no-event date ".($date->diff($today)->format("%d")==0?"programmation--emission-no-event-today":"")." date' data-date='".$date->format("Ymd")."'>".($date->diff($today)->format("%d")==0?"<aside class='event-aside'>Aujourd'hui</aside>":"")."</div>";

                    $date->add(new DateInterval('P1D'));
                }
                ?>
                <!-- <div id="programmation--google-sheet">
				<iframe src="<?php //the_field('programmation-link-google') ?>"></iframe>
			</div> -->
                <!-- <div id="programmation--google-calendar">
				<?php //the_field('programmation-calendrier') ?>
			</div> -->
                <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                <section id="programmation--emission-colonne" class="row">
                    <?php do_action('list_emission') ?>
                </section>
            </article>
        <?php endwhile;?>

        <?php do_action( 'foundationpress_after_content' ); ?>

    </div>

<script>
    $(function(){$(".date").each(function () {
        $(this.append(moment($(this).attr("data-date")).format('dddd LL')));
    });});
</script>

<?php get_footer();
function sortCalendar($a,$b)
{
    $dateA= new DateTime($a->start->dateTime);
    $dateB= new DateTime($b->start->dateTime);
    return $dateA->getTimestamp() - $dateB->getTimestamp();
}?>
