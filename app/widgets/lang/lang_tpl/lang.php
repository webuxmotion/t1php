<select class="js-lang-select">

  <option value="<?=$this->lang['code']?>" selected><?=$this->lang['code']?></option>
  <?php foreach ($this->langs as $k => $v): ?>

    <?php if ($k != $this->lang['code']): ?>
      <option value="<?=$k;?>"><?=$k?></option>
    <?php endif; ?>
  <?php endforeach; ?>
</select>
