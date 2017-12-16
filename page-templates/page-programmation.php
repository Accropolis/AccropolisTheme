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
$dateDeb=(date('c'));
$dateFin = date('c',strtotime($dateDeb.' +15 days'));

$client = getClient();
$service = new Google_Service_Calendar($client);

$calendarId=["tv8ulmfd66rvm0usr7mhjstogc@group.calendar.google.com",
    "4089pseg009iqs6h2fap5vv9i4@group.calendar.google.com",
    "k2ovdv68mq92g4k3qk1fpdnft8@group.calendar.google.com",
    "mdtvulfob62hs8p77qhm90jnuo@group.calendar.google.com",
    "4f8asbgpflh0gneqb2oe3qaiqg@group.calendar.google.com",
    "1ekodrv7a6he47n3g8hbf2ah5s@group.calendar.google.com",
    "271665r41i0955is8n2c41i4is@group.calendar.google.com",
    "jg8mvrv45tg05j9icb3qu1ttd4@group.calendar.google.com"];

$optParams = array(
    'orderBy' => 'startTime',
    'singleEvents' => TRUE,
    'timeMin' => $dateDeb,
    'timeMax' => $dateFin,
);
$results = array();
foreach ($calendarId as $id)
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

                                echo"<article class='event'>";//if class past / en cours / a venir
                                    $dateEventDeb=new DateTime($event->start->dateTime);
                                    $dateEventFin=new DateTime($event->end->dateTime);
                                    echo"<div class='logo-colonne'>";
                                        echo"<a href='https://calendar.google.com/calendar/ical/".urlencode($event->calendar)."/public/basic.ics' target='_blank'><i class='fa fa-calendar'></i></a>";
                                        echo"div class='logo'><img src='$event->logo' style='max-width: 20%;'></div>";
                                    echo"</div>";
                                    echo"<div class='text-colonne'>";
                                    echo"<p class='horaire'>".$dateEventDeb->format("H:i")." - ".$dateEventFin->format("H:i")."</p>";
                                    echo"<h2>".$event->getSummary()."<h2>";
                                    echo"<div class='caster-colonne'>";
                                        foreach ($event->casters as $caster)
                                            echo"<div class='img-colonne'><img src='$caster'></div>";
                                    echo"</div>";
                                    echo"</div>";
                                    echo"<div class='button-colonne'>"; //live class
                                        echo"<a href='".$event->htmlLink."' target='_blank'><i class='fa fa-calendar'></i></a>";
                                        echo"<div class='live-now'>live en cours</div>";
                                        //bouton live en cours / twitch / youtube
                                    echo"</div>";
                                $event = array_shift($listEvent);
                                echo "</article>";
                            }
                        echo "</div>";
                    }
                    else
                        echo "<div class='programmation--emission-no-event ".($date->diff($today)->format("%d")==0?"programmation--emission-no-event-today":"")."'>".($date->diff($today)->format("%d")==0?"<aside class='event-aside'>Aujourd'hui</aside>":"").$date->format("Y-m-d")."</div>";

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
    console.log(moment().format('MMMM Do YYYY, h:mm:ss a'));
</script>

<?php get_footer();

function sortCalendar($a,$b)
{
    $dateA= new DateTime($a->start->dateTime);
    $dateB= new DateTime($b->start->dateTime);
    return $dateA->getTimestamp() - $dateB->getTimestamp();
}
