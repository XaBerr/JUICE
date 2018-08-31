<?php
  class Page01 extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "Page01";
      $this->tags["content"] = $this->makePage();
    }
    public function makePage() {
      jBlock();
      ?>
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            Page 01!
          </div>
        </div>
      </div>
      <?php
      $temp = jBlockClose();
      return $temp;
    }
  }
?>
