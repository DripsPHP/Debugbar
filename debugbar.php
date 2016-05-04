
    <link a href="style_debugbar.css" rel="stylesheet">

<div id="debugbar">
    <header id="debugbar-header">
        <nav>
            <a href="#debugbartab-A">A</a>
            <a href="#debugbartab-B">B</a>
            <a href="#debugbartab-C">C</a>
        </nav>
    </header>
    <div id="debugbar-content">
        <div class="tab" id="debugbartab-A">
            Tab 1
        </div>
        <div class="tab" id="debugbartab-B">
            Tab 2
        </div>
        <div class="tab" id="debugbartab-C">
            Tab 3
        </div>
    </div>
</div>

<script>
  window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"><\/script>')
</script>

<script>
$(document).ready(function(){
    $("#debugbar-content .tab").eq(0).show();

    $("#debugbar-header a").click(function(e){
        e.preventDefault();
        e.stopPropagation();
        id = $(this).prop("href").substr($(this).prop("href").indexOf("#"));
        $("#debugbar-content .tab").hide();
        $("#debugbar-content").show();
        $(id).show();
    });

    $("#debugbar-header").click(function(e){
        $("#debugbar-content").toggle();
    });
});
</script>
