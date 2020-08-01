<div class="btn-group">
  <?php foreach ($this->langs as $k => $v): ?>
    <a href="/lang/change?lang=<?=$k?>" type="button" class="btn btn-default <?=$this->lang['code'] === $k ? 'active' : null;?>"><?=$k?></a>
  <?php endforeach; ?>
</div>
