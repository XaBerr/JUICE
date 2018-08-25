<?php
  class Home extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "Home";
      $this->tags["content"] = $this->makePage();
    }
    public function makePage() {
      jBlock();
      ?>
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            Hello World!
          </div>
        </div>
      </div>
      <?php
      $temp = jBlockClose();
      return $temp;
    }
  }
?>
