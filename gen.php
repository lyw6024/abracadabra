<?php

function random()
{
    return rand(0,100)/100;
}

$rawMessage = array();
$proverbs=json_decode(file_get_contents("store/proverbs"),true);
$prep=array();
$proverbsPrefix = array();
$proverbsSuffix = array();

// read from files
$fp=fopen("store/rawSentences","r");
while(!feof($fp))
{
    array_push($rawMessage,fgets($fp));
}
fclose($fp);

$fp=fopen("store/prep","r");
while(!feof($fp))
{
    array_push($prep,fgets($fp));
}
fclose($fp);

$fp=fopen("store/pPrefix","r");
while(!feof($fp))
{
    array_push($proverbsPrefix,fgets($fp));
}
fclose($fp);


$fp=fopen("store/pSuffix","r");
while(!feof($fp))
{
    array_push($proverbsSuffix,fgets($fp));
}
fclose($fp);

//

function abracadabra($arr)
{
    // select a sentence randomly. 
    return $arr[rand(0,count($arr)-1)];
}

function sayProverbs($prvb,$prefix,$suffix)
{
    // construct proverbs
    $pvname=abracadabra(array_keys($prvb));
    $pvContent=$prvb[$pvname];
    $pf=abracadabra($prefix);
    $sf=abracadabra($suffix);
    return $pvname.$pf.":".$pvContent.$sf;
}

$event=$_GET["event"];
$length=$_GET["length"];

$writtenFont=1;
if($_GET["isWritten"]=='0')
    $writtenFont=0;

$addChar=1;
if($_GET["counterType"]=='0')
    $addChar=0;

$idx=0;


if($writtenFont==1)
    echo '<p style="font-size:24px;">';

while ($idx<$length)
{

    if ($idx>0 && random()<0.05)
        echo '<br/>';
    if (random()<0.2)
    {
        $msg=sayProverbs($proverbs,$proverbsPrefix,$proverbsSuffix);
    }
    else
    {
        $msg="";
        if(random()<0.1)
        {
            $msg=abracadabra($prep);
        }
        $msg=$msg.abracadabra($rawMessage);
        $msg=str_replace("EVENT", $event, $msg);        
    }
    if($writtenFont==1)
        echo '<span style="font-family:w'.rand(0,3).'">'.$msg.'</span>';
    else
        echo $msg;
    if($addChar==0)
        $idx+=floor(strlen($msg)/3);
    else
        $idx+=1;
}
if($writtenFont==1)
{
echo '</p>';
}
?>
