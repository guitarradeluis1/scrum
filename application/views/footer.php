	<p class="footer"><b>Scrum</b> - Luis Bernal S. (<strong>{elapsed_time}</strong> seconds)</p>
</div>
<script>
$(document).ready(function()
{
    //____________________________________________
    $(".desplegar").click(Deplegar);
});
//______________________________________________--
function Deplegar()
{
    var des = $(this).attr("despliego");
    $("#"+des).toggle("slow");
}
</script>
</body>
</html>