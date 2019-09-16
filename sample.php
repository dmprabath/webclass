<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
 <title>Untitled</title>
 <style>
  BODY { font-family : MS Sans Serif; font-size : 8pt; background : #EEE; color : 777;}
  #about { width : 350px; border: 1px solid #000; background: #E2E3F5; padding: 5 10 10 7; color : 000; }
  #title { font-family : Verdana; font-weight : bold; font-size : 16pt; color : 000; border-bottom : 1px solid #000; padding : 5 0; font-variant : small-caps; letter-spacing : 10px; }
 </style>
 
 <script>
  function filterInput(e) {
   // Get the regular expression to test against for this particular object
   regAllow = (e)?eval(e.allow):eval(event.srcElement.allow);
   // Check for an allowed character, if not found, cancel the keypress's event bubbling
   if (!String.fromCharCode(event.keyCode).match(regAllow)) event.returnValue=false;
  }
 </script>
</head>
<body>

<div id="title">Input Filtering</div>
<br><br>
Only normal characters allowed:<br>
<input type="text" size="40" onKeyPress="filterInput(this)" allow="/[A-Za-z]/"><br>
<br>
Numbers and uppercase letters + spaces allowed (for zip codes):<br>
<input type="text" size="40" onKeyPress="filterInput(this)" allow="/[A-Z0-9\\s]/"><br>
<br>
Normal characters and spaces + interpunction allowed (sentences):<br>
<input type="text" size="40" onKeyPress="filterInput(this)" allow="/[A-Za-z\\s,.?!]/"><br>
<br>

</body>
</html>