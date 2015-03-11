<?PHP
    $file_name="../../sstraffic";//========================Remember to modify: your file location;
    $fp=fopen($file_name,'r');
    $n=2;//=====================================================Remember to modify: Total Persons;
    while(!feof($fp))
    {
        $line=fgets($fp,4096);
        if (strtok($line,' ')=="#") {
        }
        elseif (strtok($line,' ')==null) {
        }
        else {
            switch (strtok($line,' '))
            {
                case port1; //========================================input your port number here;
                    $i=5*1;
                    $counter[$i]="Name1";
                    break;
                case port2; //========================================input your port number here;
                    $i=5*2;
                    $counter[$i]="Name2";
                    break;
                case port3; //========================================input your port number here;
                    $i=5*3;
                    $counter[$i]="Name3";
                    break;
                default:
                    $i=0;
                    $counter[$i]="Sum";
                    break;
            }
            
            //define remain;
            $i=$i+3;
            $counter[$i]=substr(strrchr($line, "("), 1,-2);
            $line=substr($line, 0, strlen($line)-strlen($counter[$i])-3);
            $remain=substr(strrchr($line, ")"), 1);
            //define used;
            $i--;
            $drop=substr(strrchr($line, "("), 1);
            $temp=strstr($drop, ')');
            $counter[$i]=substr($drop,0,strlen($drop)-strlen($temp));
            $line=substr($line,0,strlen($line)-strlen($drop)-1);
            $used=substr(strrchr($line, ")"), 1);
            //define total;
            $i--;
            $drop=substr(strrchr($line, "("), 1);
            $temp=strstr($drop, ')');
            $counter[$i]=substr($drop,0,strlen($drop)-strlen($temp));
            $line=substr($line,0,strlen($line)-strlen($drop)-2);
            $total=$remain+$used;
            //define used rate (%);
            $i=$i+3;
            $counter[$i]=100*$used/$total;
            
            //show traffic;
            //$i=$i-4;
            //show Name;
            //echo $counter[$i]."	";
            //show total traffic;
            //echo "Total: ".$counter[$i+1]."	";
            //show used traffic;
            //echo "Used: ".$counter[$i+2]."	";
            //show remain traffic;
            //echo "Remain: ".$counter[$i+3]."<br>";
            //show used rate;
            //echo "User rate: ".$counter[$i+4]."%"."<br>";
        }
        
    }
    fclose($fp);
    ?>
<!doctype html>
<html>
<head>
<title>Traffic sum</title>
<script src="Chart.js"></script>
<style type="text/css">
body
{
margin: 0;
padding: 20px;
color: #000;
background: #fff;
font: 100%/1.3 helvetica, arial, sans-serif;
}

h1 { margin: 0; }
.container { width: 100%; }

table
{
margin: 0;
    border-collapse: collapse;
}

td, th
{
padding: .5em 1em;
border: 1px solid #999;
}

.table-container
{
width: 100%;
    overflow-y: auto;
    _overflow: auto;
margin: 0 0 1em;
}

.table-container::-webkit-scrollbar
{
    -webkit-appearance: none;
width: 14px;
height: 14px;
}

.table-container::-webkit-scrollbar-thumb
{
    border-radius: 8px;
border: 3px solid #fff;
    background-color: rgba(0, 0, 0, .3);
}
</style>
</head>
<body>

<div class="table-container">
<br>
<br>
Traffic Show
<br>
<table>
<tr>
<th>User</th>
<th>Remain</th>
<th>Used</th>
<th>Total</th>
</tr>
<?php
    for ($i=1;$i<=$n;$i++){
        echo "<tr>";
        echo "<td>".$counter[5*$i]."</td>";
        echo "<td>".$counter[5*$i+3]."</td>";
        echo "<td>".$counter[5*$i+2]."</td>";
        echo "<td>".$counter[5*$i+1]."</td>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<td>".$counter[0]."</td>";
    echo "<td>".$counter[3]."</td>";
    echo "<td>".$counter[2]."</td>";
    echo "<td>".$counter[1]."</td>";
    echo "</tr>";
?>
</table>
</div>

<div style="width: 50%">
<br>
<br>
Used Rate Show (%)
<br>
<canvas id="canvas" height="450" width="600"></canvas>
</div>


<script>
var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

var barChartData = {
    labels : [
    <?php
    for ($i=1;$i<=$n;$i++){
        echo "\"".$counter[5*$i]."\"".",";
    }
    echo "\"".$counter[0]."\""
    ?>
    ],
    datasets : [
    {
        fillColor : "rgba(220,220,220,0.5)",
        strokeColor : "rgba(220,220,220,0.8)",
    highlightFill: "rgba(220,220,220,0.75)",
    highlightStroke: "rgba(220,220,220,1)",
        data : [
        <?php
        for ($i=1;$i<=$n;$i++){
            echo $counter[5*$i+4].",";
        }
        echo $counter[4];
        ?>
        ]
    },
    
    ]
    
}
window.onload = function(){
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData, {
                                      responsive : true
                                      });
}

</script>
</body>
</html>

