<div class="pagination">
    <?php if ($currentPage>3) { 
            $firstPage=1;
        ?>
        <a class="page-item" href="<?=$queryString?>&page=<?=$firstPage?>">Đầu</a> 
    <?php } ?>

    <?php if ($currentPage>1) { 
            $prevPage=$currentPage-1;
        ?>
        <a class="page-item" href="<?=$queryString?>&page=<?=$prevPage?>">Trước</a> 
    <?php } ?>

    <?php for ($i=1; $i<=$totalPages; $i++){ ?>
        <?php if ($currentPage != $i) { ?>
            <?php if ($i > $currentPage-3 && $i<$currentPage+3) { ?>
                <a class="page-item" href="<?=$queryString?>&page=<?=$i?>"><?=$i?></a> 
            <?php } ?>
        <?php } else { ?>
            <strong class="current-page page-item"><?=$i?></strong>
        <?php } ?>
            
    <?php } ?>

    <?php if ($currentPage<$totalPages-1) { 
            $nextPage=$currentPage+1;
        ?>
        <a class="page-item" href="<?=$queryString?>&page=<?=$nextPage?>">Sau</a> 
    <?php } ?>

    <?php if ($currentPage< $totalPages-3) { 
            $lastPage=$totalPages;
        ?>
        <a class="page-item" href="<?=$queryString?>&page=<?=$lastPage?>">Cuối</a> 
    <?php } ?>

</div>