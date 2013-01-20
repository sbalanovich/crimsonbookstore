<script type="text/javascript">
//reidrects on click
function DoNav(theUrl)
{
document.location.href = theUrl;
}
</script>

<div id="centercontent">
<br/>
<table style="color:#FFFFFF; padding:15px;" class="table table-hover" data-provides="rowlink">
    <thead>
        <tr>
            <th></th>
            <th style="text-align:center;"><h3>Author</h3></th>
            <th style="text-align:center;"><h3>Title</h3></th>
            <th style="text-align:center;"><h3>ISBN</h3></th>
        </tr>
    </thead>
    <tbody>
        <?php while($results = mysql_fetch_array($raw_results)): ?>

            <tr onclick="DoNav('upload.php?book=<?= $results['id'] ?>');">
            <?php
            $picture=$results["picture"];
            print("<td style=\"text-align:center;\"><img id=\"coverpreview\"src=" . $picture . "></td>");
            ?>
            <td style="text-align:center;"><h5><?= $results["author"] ?></h5></td>
            <td style="text-align:center;"><h5><?= $results["title"] ?></h5></a></td>
            <td style="text-align:center;"><h5><?= $results["ISBN"] ?></h5></a></td>
            </tr>

        <? endwhile ?>

    </tbody>

</table>
</div>
