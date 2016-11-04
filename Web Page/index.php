<?php
date_default_timezone_set("Asia/Tokyo"); 
$date= strtoupper(date("M jS l", time()));


$vol=(isset($_REQUEST['f_vol'])?$_REQUEST['f_vol']:20);
// youtube code, time to display in seconds
// multiplier m
$m=1000;

// LIST OF 8 YOUTUBE LIVESTREAM FEEDS

// MKME TV LIVE
// https://www.youtube.com/watch?v=04jBi_yHyZw
$streams[1]['name']="ME";
//$streams[1]['url']="UCfDqotmv53kzbfgqoDdL7NQ"; // THIS IS THE MKME CHANNEL ID, NEEDS THE VIDEO/STREAM ID
$streams[1]['url']="04jBi_yHyZw";
$streams[1]['time']=3300*$m;

// FRANCE 24 live news stream: all the latest news 24/7
// https://www.youtube.com/watch?v=gq11un3xqsA
$streams[2]['name']="FN";
$streams[2]['url']="gq11un3xqsA";
$streams[2]['time']=3300*$m;

// The Good Life Radio • 24/7 Music Live Stream | Deep & Tropical House | Chill Out | Dance Music Mix
// https://www.youtube.com/watch?v=uNN6Pj06Cj8
$streams[3]['name']="M1";
$streams[3]['url']="uNN6Pj06Cj8";
$streams[3]['time']=3300*$m;

// UNAVAILABLE
// https://www.youtube.com/watch?v=mlwVFG10JaU
$streams[4]['name']="M2";
$streams[4]['url']="mlwVFG10JaU";
$streams[4]['time']=3300*$m;

// Mixhound - 24/7 Music Livestream · Chillstep · Melodic Dubstep · House · Chill Music · Futurebass
// https://www.youtube.com/watch?v=dxVzsVFAw34
$streams[5]['name']="m3";
$streams[5]['url']="dxVzsVFAw34";
$streams[5]['time']=3300*$m;

// Earth From Space: GoPro ISS Spacewalk | ISS HD Stream - Video Replay Of EVA Russian Cosmonauts 2013
// https://www.youtube.com/watch?v=OlzeBNep6Pw
$streams[6]['name']="S1";
$streams[6]['url']="OlzeBNep6Pw";
$streams[6]['time']=3300*$m;

// 24/7 STREAM: 👽🌎 "EARTH FROM SPACE" ♥ NASA #SpaceTalk (2016) ISS HDVR | Subscribe now!
// https://www.youtube.com/watch?v=UGPuEDyAsU8
$streams[7]['name']="S2";
$streams[7]['url']="UGPuEDyAsU8";
$streams[7]['time']=3300*$m;

// NASA TV Public-Education
// https://www.youtube.com/watch?v=UdmHHpAsMVw
$streams[8]['name']="S3";
$streams[8]['url']="UdmHHpAsMVw";
$streams[8]['time']=3300*$m;

// TO EDIT FEEDS...
// $streams[X]['url'] = "[INSERT YOUTUBE CODE HERE]"
//
// REFER TO YOUTUBE FOR DIFFERENT LIVESTREAMS: https://www.youtube.com/live
//
// EXAMPLES (YOUTUBE CODES)
// DKAywnK5q1M - Southwest Florida Eagle Cam
// YPv9yKC76hE - Kitten Academy Live Stream
// vwREO4Ahv-E - www.deertrail.us

$s=getS($streams);
$n=$streams[$s]['name'];
$u=$streams[$s]['url'];
$t=$streams[$s]['time'];

$next=($s==count($streams)?1:$s+1);
?>
<html>
<head>
    <meta charset="utf-8">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700,inherit,400" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="weather.css">
    <link rel="stylesheet" href="rasp.css">

    <script type="text/javascript">
        // PHP dependant js vars ~
        // page udate after t seconds
        setTimeout(function(){ document.forms["poster"].submit(); }, <?php echo $t; ?>);
        // volume ON/OFF morning/evening
        var on, off, vol = <?php echo $vol; ?>;
        // bbc headlines 
        var headlines =[<?php echo getHeadlines(); ?>];
    </script>
</head>

<body>
    <div class ="col1">
        <p><iframe id="ytplayer" width="100%" height="410" src="https://www.youtube.com/embed/<?php echo $u; ?>?rel=0&autoplay=1&enablejsapi=1" frameborder="0" allowfullscreen></iframe>
        </p>
        <span id="digi">
            <span id="dc"></span><br />
            <span id="date"><?php echo $date; ?></span>
        </span>

        <div class="weather">
            <div class="w_left">
                <p class="temperature"></p>
                <p class="location"></p>
            </div>
            <div class="w_right">
                <div class="climate_bg"></div>
                <p class="forecast"></p>
                
                <div class="info_bg"> 
                    <p class="i1"><img class="dropicon" src="images/Droplet.svg"><span class="humidity"></span></p>       
                    <p class="i2"><img class="windicon" src="images/Wind.svg"><span  class="windspeed"></span></p>
                    <div style="clear: both;"></div>
                </div>
            </div>
    
            <p class="updated"></p>
            <div style="clear: both;"></div>
        </div>

        <div id="nav">
                      <ul>
                <li>Vol</li>
                <li class="btn" id="mute-toggle">x</li>
                <li class="btn" id="vol20">20</li>
                <li class="btn" id="vol50">50</li>
                <li class="btn" id="vol100">100</li>
            </ul>
            
               <ul class="vid">
                <li>Vid</li>
                <?php
                foreach($streams as $key => $value){
                    ?>
                <a href="index.php?s=<?php echo $key; ?>"><li class="btn2<?php echo isPlaying($key); ?>"><?php echo $streams[$key]['name']; ?></li></a>
                <?php
                $s++;
                }
                ?>
            </ul>
            
            <ul class="vid">
                <a href="web.php"><li class="btn2">www</li></a>
                        </ul>


        </div>
  
    </div>


    <div class="col2 <?php echo bg('col2'); ?>">
        <a href="javascript:;" onclick="document.forms['poster'].submit();">
            <div class="clocks">
                <canvas id="canvas" width="500" height="500"></canvas>
            </div>
        </a>

        <div id="news"></div>

    </div>
    <div style="clear: both;"></div>

    <form id="poster" method="post" action="index.php?s=<?php echo $next; ?>">
        <input type="hidden" id="f_vol" name="f_vol" value="<?php echo $vol; ?>" />
    </form>

    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="jquery-2.2.3.min.js"></script>
    <script src="jquery.simpleWeather.min.js"></script>
    <script src="weather.js"></script>
    <script src="jsclock.js"></script>
    <script src="library.js"></script>

    <script type="text/javascript">    
        auto_volume();
        showNews(headlines);
    </script>
    
</body>
</html>

<?php
function bg($id){
    $col2=array('col1_sunrise','col1_morning','col1_midday','col1_evening','col1_night');
    $hr=date('H', time()); 

    if($hr<=5){
        $class=${$id}[4];
    }elseif($hr<=9){
        $class=${$id}[0];
    }elseif($hr<=12){
        $class=${$id}[1]; 
    }elseif($hr<=17){
        $class=${$id}[2];    
    }elseif($hr<=20){
        $class=${$id}[3];
    }else{
        $class=${$id}[4];
    }
    return $class;
}

function getHeadlines(){
    $html="";
    
    // NEWS FROM RSS FEED 
    // $file=file_get_contents("http://feeds.bbci.co.uk/news/rss.xml?edition=uk"); // BBC UK
    
    // FOR BBC US NEWS, JUST CHANGE THE 'edition' PARAMETER IN THE LINK ABOVE TO 'US'
    $file=file_get_contents("http://feeds.bbci.co.uk/news/rss.xml?edition=us"); // BBC US
    
    // OR TRY OTHER RSS NEWS FEEDS...
    // http://rss.nytimes.com/services/xml/rss/nyt/World.xml
    // http://www.cbc.ca/cmlink/rss-world
    
    preg_match_all("%<title>(.*?)</title>%s", $file, $titles,PREG_PATTERN_ORDER,920);
    preg_match_all("%<link>(.*?)</link>%s", $file, $links,PREG_PATTERN_ORDER,920);
    preg_match_all("%<description>(.*?)</description>%s", $file, $desc,PREG_PATTERN_ORDER,920);

    for($i=0;$i<=19;$i+=2){
        $html.="'<a href=\"".$links[1][$i]."\">".clean($titles[1][$i])."</a><br><span>".clean($desc[1][$i])."</span>',";
    }
    return $html;
}

function clean($val){
    $val=str_replace("'","",$val);
    $val=str_replace("<![CDATA[","",$val);
     $val=str_replace("]]>","",$val);
    return $val;
}

function getS($streams){
$output=1;
    if(isset($_GET['s']) && array_key_exists($_GET['s'],$streams)){
        $output=$_GET['s'];
    } 
    return $output;
}

function isPlaying($key){
    $c="";
    if($_GET['s']==$key){
        $c=" play";
    }
    return $c;
}
?>
