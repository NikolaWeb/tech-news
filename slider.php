<div class="container">
    <div class="col-md-12 space-top">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
            </ol>


            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

            <?php
                $query = "SELECT * FROM slider";

                $res = $conn->query($query)->fetchAll();

                $i=0;
                foreach($res as $r):
            ?>
              <div class="item <?php if($i == 0){echo "active"; } ?>">
                <a href="?page=3&news=<?= $r->news_id; ?>"><img src="<?php echo $r->url; ?>" alt="<?php echo $r->alt; ?>"></a>

              </div>
            <?php
                $i++;
                endforeach;
            ?>
              </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>