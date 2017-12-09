<?php
error_reporting(-1);

define('APPLICATION_NAME', 'Google Calendar API PHP Quickstart');
define('CREDENTIALS_PATH', '~/.credentials/calendar-php-quickstart.json');
define('CLIENT_SECRET_PATH', 'client_secret.json');
// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/calendar-php-quickstart.json;
// TODO: Externaliser les constantes pour qu'elles n'apparaissent pas sur le GitHub
define('GOOGLE_CLIENT_ID',"981636069101-3tiu7a9hj5qrojvv0j6vv6j8o9acvq6i.apps.googleusercontent.com");
define('GOOGLE_CLIENT_SECRET',"hxATTSqdZ6gkYhgImgTUaGxl");
define('GOOGLE_API_KEY',"AIzaSyDnbxsJbt2MietwVVRZORFFZF0bNRKhN78");
define('GOOGLE_REDIRECT_URL',"127.0.0.1");
define('GOOGLE_SCOPES',implode(' ', array(Google_Service_Calendar::CALENDAR)));
define('GOOGLE_APPROVAL_PROMPT',"force");
define('GOOGLE_ACCESS_TYPE',"offline");
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

$calendarId = array();

/*$args = array(
    'post_type' => 'calendrier',
    'order' => "ASC"
);
$query1 = new WP_Query( $args );
if ( $query1->have_posts() ) {
    // The Loop
    while ( $query1->have_posts() ) {
        $query1->the_post();
        $taxonomies = get_the_taxonomies();
        $id =format($taxonomies["calendrierid"]);
        $calendarId[$id]=array();
        $calendarId[$id]["logo"]=format($taxonomies["calendrierlogo"]);
        $calendarId[$id]["caster"]=explode(" et ",format($taxonomies["calendriercaster"]));
    }

    /* Restore original Post Data
     * NB: Because we are using new WP_Query we aren't stomping on the
     * original $wp_query and it does not need to be reset with
     * wp_reset_query(). We just need to set the post data back up with
     * wp_reset_postdata().
     */
    /*wp_reset_postdata();
}
wp_reset_query();*/


$calendarId["irldqcjmqj1fo3resdpg3clv5c@group.calendar.google.com"]=array();
$calendarId["irldqcjmqj1fo3resdpg3clv5c@group.calendar.google.com"]["logo"]="http://127.0.0.1/wordpress/wp-content/uploads/2017/12/Logo-transparent-pleine-page-1024×490.png";
$calendarId["irldqcjmqj1fo3resdpg3clv5c@group.calendar.google.com"]["caster"]=array("http://127.0.0.1/wordpress/wp-content/uploads/2017/12/caster-jean.jpeg");

$calendarId["tfete7o5346ftpftbu84u9el2g@group.calendar.google.com"]=array();
$calendarId["tfete7o5346ftpftbu84u9el2g@group.calendar.google.com"]["logo"]="http://127.0.0.1/wordpress/wp-content/uploads/2017/12/logo-insideaccropolis.jpeg";
$calendarId["tfete7o5346ftpftbu84u9el2g@group.calendar.google.com"]["caster"]=array("http://127.0.0.1/wordpress/wp-content/uploads/2017/12/caster-jean.jpeg");

$calendarId["vf58v4mhhj4s4vs027hdeiaiq8@group.calendar.google.com"]=array();
$calendarId["vf58v4mhhj4s4vs027hdeiaiq8@group.calendar.google.com"]["logo"]="http://127.0.0.1/wordpress/wp-content/uploads/2017/12/LEurope-lEurope-lEurope.png";
$calendarId["vf58v4mhhj4s4vs027hdeiaiq8@group.calendar.google.com"]["caster"]=array("http://127.0.0.1/wordpress/wp-content/uploads/2017/12/caster-jennifer.jpeg");

$calendarId["ipdbt0lst9uaeii8mca070ugrc@group.calendar.google.com"]=array();
$calendarId["ipdbt0lst9uaeii8mca070ugrc@group.calendar.google.com"]["logo"]="http://127.0.0.1/wordpress/wp-content/uploads/2017/12/Logo-transparent-pleine-page-1024×490.png";
$calendarId["ipdbt0lst9uaeii8mca070ugrc@group.calendar.google.com"]["caster"]=array("http://127.0.0.1/wordpress/wp-content/uploads/2017/12/caster-jean.jpeg");


var_dump($calendarId);

$optParams = array(
    'orderBy' => 'startTime',
    'singleEvents' => TRUE,
    'timeMin' => $dateDeb,
    'timeMax' => $dateFin,
);
$results = array();
foreach ($calendarId as $id=>$value)
{
    try {
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
        $event->casters=$calendarId[$id]["caster"];
        $event->logo=$calendarId[$id]["logo"];
        $listEvent[] = $event;
    }
}

usort ( $listEvent,"shortCalendar");
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
                    echo $date->format("Y-m-d")."<br/>";

                    if($event!=null && $date->diff(new DateTime($event->start->dateTime))->format("%d")==0)
                    {
                        $diff = $date->diff($today)->format("%d");
                        switch ($diff)
                        {
                            case 0:echo "Aujourd'hui";break;
                            case 1:echo "Demain";break;
                            default: echo"dans ".$diff." jours<br/>";
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
                                        if(strpos($event->casters[0],"wordpress"))
                                            $event->casters=array();

                                        $event->casters[] = "https://drive.google.com/uc?export=view&id=".$attachment->fileId;
                                    }
                                }
                            }

                            $dateEventDeb=new DateTime($event->start->dateTime);
                            $dateEventFin=new DateTime($event->end->dateTime);
                            echo"<div>";
                            echo"<strong>".$dateEventDeb->format("H:i")." - ".$dateEventFin->format("H:i")."</strong><br/>".$event->getSummary()."<br/>";
                            echo"<a href='".$event->htmlLink."' target='_blank'><i class='fa fa-calendar'></i></a>";
                            echo"<a href='https://calendar.google.com/calendar/ical/".urlencode($event->calendar)."/public/basic.ics' target='_blank'><i class='fa fa-calendar'></i></a>";
                            echo"<strong>LOGO</strong><br/><img src='$event->logo' style='max-width: 20%;'></br>";
                            echo"<strong>CASTER</strong><br/>";
                            foreach ($event->casters as $caster)
                                echo"<img src='$caster'>";
                            echo"</div>";
                            $event = array_shift ($listEvent);

                        }
                    }
                    else
                        echo "aucun evenement</br>";

                    $date->add(new DateInterval('P1D'));
                    echo "<hr>";
                }


                foreach($listEvent as $event)
                {
                    echo"<pre>";
                    var_dump($event);
                    echo"</pre>";
                }


                /*foreach ($results as $calendar)
                    if (count($calendar->getItems()) == 0)
                    {
                        echo "No upcoming events found.\n";
                    }
                    else {
                        echo "Upcoming events:\n";
                        foreach ($calendar->getItems() as $key => $event) {
                            //$service->colors->get($event->id);
                            echo '<pre>';
                              //var_dump($event->getAttendees());
                              var_dump($event);
                            echo '</pre>';
                            //echo("<pre>".json_encode($event,JSON_PRETTY_PRINT)."</pre>");
                            $start = $event->start->dateTime;
                            if (empty($start)) {
                                $start = $event->start->date;
                            }
                            echo("<p>".$event->getSummary()." ".$start." ".$event->htmlLink."</p>");
                            if(isset($event->attachments))
                            {

                                foreach($event->attachments as $attachment)
                                {
                                    echo "<img src='https://drive.google.com/uc?export=view&id=".$attachment->fileId."' alt=''>";
                                }
                            }
                        }
                    }*/
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
                <section id="programmation--emission-wrapper" class="row">
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

function shortCalendar($a,$b)
{
    $dateA= new DateTime($a->start->dateTime);
    $dateB= new DateTime($b->start->dateTime);
    return $dateA->getTimestamp() - $dateB->getTimestamp();
}

function format($s)
{
    $exp = (explode(":",strip_tags($s)));

    if(isset($exp[2]))
        return substr($exp[1].":".$exp[2],1,-1);
    else
        return substr($exp[1],1,-1);
}
