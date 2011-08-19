<?php // $Id: insert_cloze.php,v 1.4 2011/03/10

 require("../../../../config.php");


    $id = optional_param('id', SITEID, PARAM_INT);

    require_course_login($id);
    @header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title><?php print_string('titleclozeeditor', 'cloze_editor');?></title>
  <link rel="stylesheet" href="dialog.css" type="text/css" />
<script type="text/javascript">
/* getElementByClass
/**********************/
var allHTMLTags = new Array();
function getElementByClass(theClass) {
	//Create Array of All HTML Tags
    var allHTMLTags=document.getElementsByTagName("*");

    //Loop through all tags using a for loop
    for (i=0; i<allHTMLTags.length; i++) {
		//Get all tags with the specified class name.
		if (allHTMLTags[i].className == theClass) {
			//Place any code you want to apply to all
			//pages with the class specified.
			//In this example is to �display:none;� them
			//Making them all dissapear on the page.

			if (document.Formular.quiz_type.value == "NUMERICAL") {
				allHTMLTags[i].style.display = 'block';
			} else {
				allHTMLTags[i].style.display = 'none';
			}
		}
    }
}
	
function quiz_state () {
	getElementByClass("table_value_throttle");
}

function correctness (object) {
	if (object == "first") {
		var percent_element = document.Formular.first_option_percent;
		var correct_element = document.Formular.first_correct_answer;
	} else if (object == "second") {
		var percent_element = document.Formular.second_option_percent;
		var correct_element = document.Formular.second_correct_answer;
	} else if (object == "third") {
		var percent_element = document.Formular.third_option_percent;
		var correct_element = document.Formular.third_correct_answer;
	} else if (object == "fourth") {
		var percent_element = document.Formular.fourth_option_percent;
		var correct_element = document.Formular.fourth_correct_answer;
	}
	
    if (percent_element.value == "100") {
            percent_element.readOnly = true;
            correct_element.checked = true;
			setcolor(percent_element, "off");
        } else {
            percent_element.readOnly = false;
            correct_element.checked = false;
			setcolor(percent_element, "on");
        }
}

// This Function will toggle the color of the checkbox to define an answer as true or false
// If the answer is true, the element's value should be 100 (percent) and readOnly, so there won't be any
// misunderstanding between a checked box
function setcolor(element, state) {
	if (state == "off") {
		// If the element's status is off then
		// fill with gray background color
		element.style.backgroundColor = "EEEEEE";
		element.style.color = "888888";	
		// set value to 100 and the element on readOnly
		element.value = "100";
		element.readOnly = true;
	} else if (state == "on") {
		// If the element's status is on then
		// restore original color
		element.style.backgroundColor = "white";
		element.style.color = "black";
		if (element.value == "100") { 
			// If the value is 100, then set it to 0.
			// Why? Because it cannot be 100 and at the same time be false
			// So it switches to 0 to avoid discrepancy
			element.value = "0";
		}
		// Because the answer is wrong, you might want to edit the percentage of the field, so it must be writeable
		element.readOnly = false;
	}
}

function correctness_click (object) {
    if (object == "first") {
        if (document.Formular.first_correct_answer.checked == true) {
            //document.Formular.first_option_percent.value = "100"; // wenn man "correct" ankreuzt, sollen auch 100% vergeben werden
            //document.Formular.first_option_percent.readOnly = true;
			setcolor(document.Formular.first_option_percent, "off");
			
		}
        else if (document.Formular.first_correct_answer.checked == false) {
            //document.Formular.first_option_percent.value = "0";
            //document.Formular.first_option_percent.readOnly = false;
			setcolor(document.Formular.first_option_percent, "on");
        }
    }
    else if (object == "second") {
        if (document.Formular.second_correct_answer.checked == true) {
            setcolor(document.Formular.second_option_percent, "off");
        }
        else if (document.Formular.second_correct_answer.checked == false) {
            setcolor(document.Formular.second_option_percent, "on");
        }
    }        
    else if (object == "third") {
        if (document.Formular.third_correct_answer.checked == true) {
            setcolor(document.Formular.third_option_percent, "off");
        }
        else if (document.Formular.third_correct_answer.checked == false) {
            setcolor(document.Formular.third_option_percent, "on");
        }
    } 
    else if (object == "fourth") {
        if (document.Formular.fourth_correct_answer.checked == true) {
            setcolor(document.Formular.fourth_option_percent, "off");
        }
        else if (document.Formular.fourth_correct_answer.checked == false) {
            setcolor(document.Formular.fourth_option_percent, "on");
        }
    }
}
</script>


<script type="text/javascript" src="popup.js"></script>
<script type="text/javascript">
//<![CDATA[

//Initialize
function Init() {

  __dlg_init();



};

function Init() {
  __dlg_init();
  document.getElementById('first_option').focus();
    document.getElementById("first_option").select();
    document.body.onkeypress = _CloseOnEsc;
  var param = window.dialogArguments;

};

function onOK() {
  var required = {
    "embedcode": "Please insert values and hit 'process'."
  };
  for (var i in required) {
    var el = document.getElementById(i);
    if (!el.value) {
      alert(required[i]);
      el.focus();
      return false;
    }
  }
  var fields = ["embedcode"];
  var param = new Object();
  for (var i in fields) {
    var id = fields[i];
    var el = document.getElementById(id);
    param[id] = el.value;
  }
  __dlg_close(param);
  return false;
};

function onCancel() {
  __dlg_close(null);
  return false;
};
//[[>
</script>



<style type="text/css">
html, body {
margin: 2px;
background-color: rgb(212,208,200);
font-family: Tahoma, Verdana, sans-serif;
font-size: 11px;
}
.title {
background-color: #ddddff;
padding: 5px;
border-bottom: 1px solid black;
font-family: Tahoma, sans-serif;
font-weight: bold;
font-size: 14px;
color: black;
}
td, input, select, button, label, textarea {
font-family: Tahoma, Verdana, sans-serif;
font-size: 11px;
}
button { width: 70px; }
.space { padding: 2px; }
form { margin-bottom: 0px; margin-top: 0px; }
.table_value {
      text-align: center;
      width: 60px;
}

td.table_value_throttle {
      width: 60px;
      display: none;



}
td.table_value_throttle input{
      width: 40px;


}

span.helplink {
    float: right
}

span.helplink img {
  border: none;

}
</style>

</head>
<body onload="Init()">
<?php
 

//FORMULAR.PHP

// erzeuge Formular mit Überschrift

if(isset($_POST['points'])) {
    $value_points = 'value="'.$_POST['points'].'"';
} else {
//Wenn kein Wert �bernommen, dann 1 Punkt als default nehmen ANDI
    $value_weighting = 'value="1"';
}

// hässliche Variablen-Initialisierung gegen noch hässlichere Fehlermeldungen
$checked_multichoice = '';
$checked_multichoice_v = '';
$checked_multichoice_h = '';
$checked_numerical = '';
$checked_shortanswer_c = '';
$checked_shortanswer = '';

if(isset($_POST['quiz_type'])) {
    $type = $_POST['quiz_type'];
    
    if ($type == 'MULTICHOICE') { $checked_multichoice = 'selected'; }
    elseif ($type == 'MULTICHOICE_V') { $checked_multichoice_v = 'selected'; }
    elseif ($type == 'MULTICHOICE_H') { $checked_multichoice_h = 'selected'; }
    elseif ($type == 'NUMERICAL') { $checked_numerical = 'selected'; }
    elseif ($type == 'SHORTANSWER_C') { $checked_shortanswer_c = 'selected'; }
    elseif ($type == 'SHORTANSWER') { $checked_shortanswer = 'selected'; }
}


//get current user language for generating the moodle.org link
$currentlang = substr(current_language(), 0, 2);

echo "<form action='".$_SERVER['PHP_SELF']."?process=true' method='post' name='Formular'>";
echo '
<div class="title">'.get_string('titleclozeeditor', 'cloze_editor').'</div>
<fieldset>
       <label for="quiz_type">'.get_string('chooseclozeformat', 'cloze_editor').'</label><br />
            <select id="quiz_type" name="quiz_type" onchange="quiz_state()">
            <option value="SHORTANSWER" '.$checked_shortanswer.'>'.get_string('shortanswer', 'quiz').'</option>
            <option value="SHORTANSWER_C" '.$checked_shortanswer_c.'>'.get_string('shortanswer', 'quiz')." (".get_string('casesensitive', 'quiz').")".'</option>
            <option value="MULTICHOICE" '.$checked_multichoice.'>'.get_string('layoutselectinline', 'qtype_multianswer').'</option>
            <option value="MULTICHOICE_V" '.$checked_multichoice_v.'>'.get_string('layoutvertical', 'qtype_multianswer').'</option>
            <option value="MULTICHOICE_H" '.$checked_multichoice_h.'>'.get_string('layouthorizontal', 'qtype_multianswer').'</option>
            <option value="NUMERICAL" '.$checked_numerical.'>'.get_string('numerical', 'quiz').'</option>
        </select>
<span class="helplink"><a target="_blank" href="http://docs.moodle.org/19/'.$currentlang.'/question/type/multianswer"><img  alt="'.get_string('help','moodle').'" src="'.$CFG->pixpath .'/help.gif" />'.get_string('help','moodle').'</a></span>
        <br /><br />
        <label for="weighting">'.get_string('defaultgrade', 'quiz').'</label> <input size=4 type="text"  id="weighting" name="weighting" '.$value_weighting.'><br />';


//jetzt brauchen wir eine tabellarische Anordnung für die Quiz-Eingaben


echo '                                                   
<table>
    <tr>
        <td class="table_value"></td>
        <td class="table_value">'.get_string('answer', 'moodle').'</td>
        <td class="table_value_throttle">'.get_string('tolerance', 'qtype_calculated').'</td>
        <td class="table_value">'.get_string('correct', 'quiz').'</td>
        <td class="table_value">'.get_string('percentcorrect', 'quiz').'</td>
        <td class="table_value">'.get_string('feedback', 'qtype_multichoice').'</td>
    </tr>';

// erstmal einen Counter setzen, damit später nicht alle textfelder einzeln erzeugt werden müssen;
// außerdem ist der Code jetzt etwas dynamischer ;-p

for ($i=1; $i<=4; $i++) {
    if ($i == 1) {
        $counter = 'first';
    } elseif ($i == 2) {
        $counter = 'second';
    } elseif ($i == 3) {
        $counter = 'third';
    } elseif ($i == 4) {
        $counter = 'fourth';
     } elseif ($i == 5) {
        $counter = 'fifth';
    }
    
?>



<?php
//SETINPUT.PHP - takes over values on reload


// Ausgabe der Eingabefelder, Checkboxen, Feedbackfelder, Prozenteingabefelder
    if (isset($_POST[$counter.'_option'])) {
        $value_option = 'value="'.trim($_POST[$counter.'_option']).'"';
   } 
		else {
    $value_option = '';
  }
    
    //markierte checkboxen nach dem Processen wieder checken
    if (isset($_POST[$counter.'_correct_answer'])) {
        if ($_POST[$counter.'_correct_answer'] == true) {
            $checked = 'checked';
        }
    } else {
        $checked = '';
    }
    
    //Prozentangaben nach dem Processen wieder setzen
    if (isset($_POST[$counter.'_option_percent'])) {
        $value_option_percent = 'value="'.trim($_POST[$counter.'_option_percent']).'"';
        if (trim((int)$_POST[$counter.'_option_percent']) >= 100) {
            $value_option_percent = 'value="100"';
            $checked = 'checked';
            $_POST[$counter.'_correct_answer'] = 'true';
        }
    } else {
        $value_option_percent = '';
    }
    
    //Feedback nach dem Processen wieder setzen
    if(isset($_POST[$counter.'_option_feedback'])) {
        $value_option_feedback = 'value="'.trim($_POST[$counter.'_option_feedback']).'"';
    } else {
        $value_option_feedback = '';
    }
    
    // Throttle-Werte nach dem Processen wieder setzen
    if(isset($_POST[$counter.'_throttle'])) {
        $value_throttle = 'value="'.trim($_POST[$counter.'_throttle']).'"';
    } else {
        $value_throttle = '';
    }
?>


<?php
//FORMULAR.PHP weiter

 
//von GET den solution-parameter ins erste Answer-Feld nehmen und correct auf checked setzen ANDI
	if (isset($_GET['solution'])){ 
		$solution = $_GET['solution'];
if ($counter == 'first' && isset($value_option)){
	$value_option = 'value="'.$solution.'"';	 
	$checked = 'checked';
	$value_option_percent = 'value="100"';

	} 
    }

   
    //Ausgabe der Textfelder und Checkboxen
    echo '
                <tr>
                    <td class="table_value"><label for="'.$counter.'_option">'.$i.' </label></td>
                    <td class="table_value"><input type="text" id="'.$counter.'_option" name="'.$counter.'_option" '.$value_option.' size="30"></td>
					<!-- // Throttle-Werte für NUMERICAL -->
					<td class="table_value_throttle"><input type="text" name="'.$counter.'_throttle" '.$value_throttle.'></td>    
					<!-- // Checkbox -->
                    <td class="table_value"><input type="checkbox" name="'.$counter.'_correct_answer" '.$checked.' onclick="correctness_click(\''.$counter.'\')"></td>
					<!-- //Prozentangabe -->
					<td class="table_value"><input type="text" name="'.$counter.'_option_percent" '.$value_option_percent.' size="4" maxlength="4" onchange="correctness(\''.$counter.'\')"></td>
					<!-- //Feedback -->
					<td class="table_value"><input type="text" name="'.$counter.'_option_feedback" '.$value_option_feedback.' size="30"></td>
				</tr>';
}

echo    '</table>';

// submit-button
echo '  <input type="submit" name="formaction" value="'.get_string('encode', 'cloze_editor').'" />';

?>
<br>
<br>

<?php
//PROCESSING.PHP


//if (isset($_GET['process'])) {
//    if ($_GET['process'] == 'true') {

//initialisiere Variablen um sinnlose Fehlermeldungen später zu vermeiden
$ausgabe = '';
$error = '';
$add_correct = '';

$standard_error_message01 = 'Sie haben nichts eingegeben bei "';
$standard_error_message02 = '".';

if (!isset($_POST['points'])) {
    $_POST['points'] = '0';
}

if (isset($_POST['quiz_type'])) {
    for ($i=0; $i<=3; $i++) {  
        $add_correct = '';
                
        // bei jeder neuen Antwortmöglichkeit muss ein # als Trennung eingefügt             
        if ($i == 0) { $option_id = 'first'; }
        elseif ($i == 1) { $option_id = 'second'; }
        elseif ($i == 2) { $option_id = 'third'; }
        elseif ($i == 3) { $option_id = 'fourth'; }
                
        /* Variablen trimmen, echt eklig! */
        $_POST[$option_id.'_option'] = trim($_POST[$option_id.'_option']);
        $_POST[$option_id.'_option_percent'] = trim($_POST[$option_id.'_option_percent']);
        $_POST[$option_id.'_throttle'] = trim($_POST[$option_id.'_throttle']);
        $_POST[$option_id.'_option_feedback'] = trim($_POST[$option_id.'_option_feedback']);
                
                
        if ($_POST[$option_id.'_option'] != '') {                // falls die Option überhaupt einen Value hat
                
            if ($ausgabe != '') {
                $ausgabe = $ausgabe.'~'; // stand früher oben bei "if $i == ...", dann kann man aber die ~ nicht weglassen bei leeren Antworten
            }    
                
            // wenn es sich bei der Antwort um eine prozentual richtige handelt, muss % vor und nach der Zahl auftachen
            $prozentfeld = $option_id.'_option_percent';
                
            if (isset($_POST[$prozentfeld])) {
                if ($_POST[$prozentfeld] == '') {
                    $percent_value = '0';			//falls das percent-Feld leergeblieben sein sollte
                } elseif ((int)($_POST[$prozentfeld]) > 100) {
                    $percent_value = '100';			//falls im percent-Feld mehr als 100 steht
                } else {							//Normalfall
                    $percent_value = $_POST[$prozentfeld];
                }
				
                $ausgabe = $ausgabe.'%'.$percent_value.'%';
                $_POST[$prozentfeld] = $percent_value;
            }
            
            if ($_POST['quiz_type'] == 'NUMERICAL') {
                if (isset($_POST[$option_id.'_throttle'])) {
                    if ($_POST[$option_id.'_throttle'] != '') {
                        $throttle_value = ':'.$_POST[$option_id.'_throttle'];
                    }
                }
                
                if (!isset($throttle_value)) {
                    $throttle_value = '';
                                                                     
                    if ($error != '') {
                        $error = $error.'<br />';
                    }
                
                    $error = $error.$standard_error_message01.$option_id.' throttle'.$standard_error_message02;
                }
            } else {
                $throttle_value = '';
            }
            
            
                            
            // Ausgabe ins Textfeld
            if ($_POST[$option_id.'_option'] != '') {
                // falls das Wort-Textfeld nicht leer ist
                if ($_POST[$option_id.'_option_feedback'] != '') {
                    // falls das Feedback-Textfeld nicht leer ist
                    $ausgabe = $ausgabe.$add_correct.$_POST[$option_id.'_option'].$throttle_value.'#'.$_POST[$option_id.'_option_feedback'];
                } elseif 
                    // falls das Feedback-Textfeld leer sein sollte
                (isset($_POST[$option_id.'_option'])) {
                    $ausgabe = $ausgabe.$add_correct.$_POST[$option_id.'_option'].$throttle_value.'#';
                        
                    if ($error != '') { // falls $error nicht leer sein sollte, muss ein Zeilenumbruch stattfinden
                        $error = $error.'<br />';
                    }
                    $error = $error.$standard_error_message01.$option_id.' option feedback'.$standard_error_message02;
                }
            } 
        } else { // falls keine Antwort gesetzt wurde ... 
            if (isset($_POST[$option_id.'_option_feedback'])) { // ... aber ein Feedback existiert ...
                if ($_POST[$option_id.'_option_feedback'] != '') { // ... und das Feedback nicht leer ist ...
                    if ($error != '') {
                        $error = $error.'<br />';
                    }
                        
                    $error = $error.$standard_error_message01.$option_id.' answer'.$standard_error_message02;
                }
            }
        }
    }
} else {
    $_POST['quiz_type'] = '';
}

/* Getestet, wie viele Zeichen pro Breite [cols] reingehen:

1.  40: 36
2.  50: 45
3.  60: 54
Abgeleitet:     100: 90 => und stimmt (fast, ~89)
Daraus folgt Formel: 
- Breite = Länge der Zeichenkette - (Länge der Zeichenkette / 10)
- Höhe = Länge der Zeichenkette / Breite des Textfeldes
*/

$textarea_breite = 73;
$ausgabe = '{'.$_POST['weighting'].':'.$_POST['quiz_type'].':'.stripslashes($ausgabe).'}';
$textarea_höhe = ceil(strlen($ausgabe) / $textarea_breite); // ceil() rundet auf und nie ab
// Ausgabe in ein Textfeld
//ID muss "embedcode" sein für Übernahme durch editor
echo '<label for="output">'.get_string('output', 'cloze_editor').'</label><br /><textarea cols="'.$textarea_breite.'" rows="'.$textarea_höhe.'" id="embedcode" name="output">'.$ausgabe.'</textarea><br />
<br />';

// Sammlung der Fehlermeldungen
if ((!isset($_POST['first_correct_answer'])) &&
    (!isset($_POST['second_correct_answer'])) &&
    (!isset($_POST['third_correct_answer'])) &&
    (!isset($_POST['fourth_correct_answer']))) {
        $error = $error.'<br/>Es gibt keine (richtige) Lösung für den Test.';
}

if ($error != '') {
//echo '
//    <fieldset>
//        <legend>Error Output</legend>
//        <label>'.$error.'</label>
//    </fieldset>';
}




 //   }
//}

?>
    </fieldset>
</form>

<form action="" method="get">

<table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr>
    <td width="20%" valign="top">
        <button type="button" name="ok" onclick="return onOK();"><?php print_string('ok', 'editor')?></button>
        <button type="button" name="cancel" onclick="return onCancel();"><?php print_string('cancel', 'editor')?></button>
    </td>

  </tr>
</table>

</form>

</body>
</html>
