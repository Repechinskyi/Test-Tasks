<li>
    <span class="clic-btn" data-table="categories" data-id="<?=$item['id']?>"><?=$item['name_category']?></span>

    <?php if( $item['files'] && is_array($item['files']) ):?>
        <?php foreach( $item['files'] as $value):?>
            <ul>
                <span class="clic-btn" data-table="documents" data-id="<?=$value['id']?>" ><?=$value['name_file']?></span>
            </ul>
        <?php endforeach;?>
    <?php endif;?>

    <?php if($item['childs']):?>
        <ul>
            <?php echo $this->categoriesToString( $item['childs'] ); ?>
        </ul>
    <?php endif;?>
</li>