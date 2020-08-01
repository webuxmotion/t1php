<div class="lang js-lang-block">
    <div class="lang__button js-lang-button"><span><?=$this->lang['name']?></span></div>
    <div class="lang__list">
      <?php foreach ($this->langs as $k => $v): ?>
          <a href="/lang/change?lang=<?=$k?>" type="button" class="lang__list-item <?=$this->lang['code'] === $k ? 'active' : null;?>"><?=$v['name']?></a>
      <?php endforeach; ?>
    </div>
</div>

