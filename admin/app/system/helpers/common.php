<?php
function prd($data){
    echo "<pre>";
    print_r($data);
    die();
}


 function setflashdata($key,$value){
      $_SESSION[$key]=$value;
}

 function flashdata($key){

     if(!isset($_SESSION[$key])){
        return null;
     }else{
        $message=$_SESSION[$key];
          unset($_SESSION[$key]);
        return $message;
     }
}

function getNameConcatenate($first_name,$middle_name,$last_name){
    $name = $first_name;
    if(isset($middle_name) && $middle_name != ""){
        $name .= " ".$middle_name;
    }
    $name .= " ".$last_name;
    return $name;
}

function getPaginationLimitString($page,$perPage = 25){
    if(isset($_GET['results']) && $_GET['results'] != ""){
        $perPage = $_GET['results'];
    }
    return " LIMIT ".(($page-1) * $perPage).", ".$perPage; 
}

function getPaginationHtml($totalresults,$page,$count,$url,$resultPerPage = 25){
    if(isset($_GET['results'])){
        $resultPerPage = $_GET['results'];
    }
    
    $total = ceil($totalresults/$resultPerPage);
    $series = array();
    $first = 0;
    $series[] = [
        'text' => "|<",
        'url' => $url."&page=1",
        'link' => true
    ];
    if($page != 1){
        $series[] = [
            'text' => "<<",
            'url' => $url."&page=".($page-1),
            'link' => true
        ];  
    }
    

    $pad = (int) ($count/2);
    $insideStart = $page - $pad;
    $insideEnd = $page+$pad;
    if($insideStart < 1){
        $insideStart = 1;
        $insideEnd = $insideEnd+1;
    }
    if($insideEnd > $total){
        $insideEnd = $total;
        $insideStart = $insideStart-1;
    }
    for($a = $insideStart; $a <= $insideEnd; $a++){
        if($a == $page){
            $series[] = [
                'text' => $a,
                'url' => $url."&page=".$a,
                'link' =>false
            ];
        }else{
            $series[] = [
                'text' => $a,
                'url' => $url."&page=".$a,
                'link' =>true
            ];
        }
        
    }

    if($page != $total){
        $series[] = [
            'text' => ">>",
            'url' => $url."&page=".($page+1),
            'link' => true
        ];  
    }
    
    $series[] = [
        'text' => ">|",
        'url' => $url."&page=".$total,
        'link' => true
    ];

    $html = '<ul class="pagination pagination-sm m-0 float-right">';
    foreach($series as $item){
        if($item['text'] != "0"){
            if($item['link']){
                $html .= '<li class="page-item"><a class="page-link" href="'.$item['url'].'">'.$item['text'].'</a></li> ';  
            }else{
                $html .= '<li class="page-item"><a class="page-link current-page" href="javascript:void(0)"><strong>'.$item['text'].'</strong></a></li> ';  
            }
        }
        
    }
    $html .= "</ul>";
    return $html;
}

function format_money($amt){
    return moneyFormatIndia($amt);
}

function imagetobase64($path){
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;
}

function moneyFormatIndia($num) {
    $explrestunits = "" ;
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}

function cal_percentage($num_amount, $num_total) {
    if($num_total == 0){
        return 0;
    }else{
        $count1 = $num_amount / $num_total;
        $count2 = $count1 * 100;
        $count = number_format($count2, 0);
        return $count;
    }
    
}

function make_code($id){
    return sprintf('%08d',$id);
}

function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {
    // open raw memory as file so no temp files needed, you might run out of memory though
    $f = fopen('php://memory', 'w'); 
    // loop over the input array
    foreach ($array as $line) { 
        // generate csv lines from the inner arrays
        fputcsv($f, $line, $delimiter); 
    }
    // reset the file pointer to the start of the file
    fseek($f, 0);
    // tell the browser it's going to be a csv file
    header('Content-Type: text/csv');
    // tell the browser we want to save it instead of displaying it
    header('Content-Disposition: attachment; filename="'.$filename.'";');
    // make php send the generated csv lines to the browser
    fpassthru($f);
    die();
}

function createJSONResponse($data){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data,true);
    die();
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}