<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
  <script type="text/javascript">
    $('#check').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9,/@._ ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});

$('#check1').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9,/@._ ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});

$('#check2').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9,/@._ ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});
$('#check3').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9,/@._ ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});
$('#check4').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9,/@._ ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});
$('#check5').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9,/@._ ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});
$('#check6').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9,/@._ ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});


    $(document).ready(function(){
   $('#check').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});

    $(document).ready(function(){
   $('#check1').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});

    $(document).ready(function(){
   $('#check2').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});

    $(document).ready(function(){
   $('#check3').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});

    $(document).ready(function(){
   $('#check4').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});

    $(document).ready(function(){
   $('#check5').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});

    $(document).ready(function(){
   $('#check6').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});


    $(document).ready(function(){
   $('#checkpass1').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});

    $(document).ready(function(){
   $('#checkpass2').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});
  </script>