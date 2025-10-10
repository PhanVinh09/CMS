<?php
$next_post = get_next_post();     // bài mới hơn
$prev_post = get_previous_post(); // bài cũ hơn

if ( $next_post || $prev_post ) : ?>
<nav class="post-nav-card" aria-label="<?php esc_attr_e('Post navigation','twentytwenty'); ?>">
  <div class="post-nav-grid <?php echo !$prev_post ? 'only-next' : ''; ?> <?php echo !$next_post ? 'only-prev' : ''; ?>">

    <?php if ( $prev_post ) : ?>
      <a class="nav-item prev" href="<?php echo esc_url( get_permalink($prev_post->ID) ); ?>">
        <span class="label">Bài viết trước</span>
        <span class="title"><?php echo wp_kses_post( get_the_title($prev_post->ID) ); ?></span>
        <time class="date" datetime="<?php echo esc_attr( get_the_date('c', $prev_post) ); ?>">
          <?php echo esc_html( get_the_date('d-m-Y', $prev_post) ); ?>
        </time>
      </a>
    <?php else : ?>
      <div class="nav-item prev empty"></div>
    <?php endif; ?>

    <?php if ( $next_post ) : ?>
      <a class="nav-item next" href="<?php echo esc_url( get_permalink($next_post->ID) ); ?>">
        <span class="label">Bài viết kế tiếp</span>
        <span class="title"><?php echo wp_kses_post( get_the_title($next_post->ID) ); ?></span>
        <time class="date" datetime="<?php echo esc_attr( get_the_date('c', $next_post) ); ?>">
          <?php echo esc_html( get_the_date('d-m-Y', $next_post) ); ?>
        </time>
      </a>
    <?php else : ?>
      <div class="nav-item next empty"></div>
    <?php endif; ?>

  </div>
</nav>
<?php endif; ?>
<style>
/* Card tổng */
.post-nav-card{
  margin-top: 2rem;
}
.post-nav-grid{
  display:grid;
  grid-template-columns: 1fr 1fr;
  gap:0;
  border:1px solid #e9ecef;
  border-radius:10px;
  background:#fff;
  overflow:hidden;
}

/* Vạch chia dọc giữa 2 cột */
.post-nav-grid::before{
  content:"";
  grid-column:1 / span 2;
}
.post-nav-grid > .nav-item:first-child{
  position:relative;
  border-right:1px solid #e9ecef;
}

/* Item */
.post-nav-grid .nav-item{
  display:block;
  padding:20px 24px;
  text-decoration:none;
}
.post-nav-grid .nav-item.empty{ pointer-events:none; background:#fff; }

/* Nhãn nhỏ trên cùng */
.post-nav-grid .label{
  display:block;
  font-size:14px;
  color:#94a3b8; /* xám nhạt */
  margin-bottom:6px;
}

/* Tiêu đề */
.post-nav-grid .title{
  display:block;
  font-size:20px;
  line-height:1.35;
  color:#0f172a; /* gần đen */
  margin-bottom:10px;
}

/* Ngày */
.post-nav-grid .date{
  display:block;
  font-size:14px;
  color:#94a3b8;
}

/* Căn phải cho cột Next */
.post-nav-grid .next{
  text-align:right;
}

/* Hover */
.post-nav-grid .nav-item:hover .title{ text-decoration:underline; }

/* Khi chỉ có 1 bên, bỏ vạch chia và cho cột đó chiếm full */
.post-nav-grid.only-prev,
.post-nav-grid.only-next{ grid-template-columns: 1fr; }
.post-nav-grid.only-prev > .nav-item:first-child,
.post-nav-grid.only-next > .nav-item:first-child{ border-right:none; }

/* Mobile */
@media (max-width: 680px){
  .post-nav-grid{ grid-template-columns:1fr; }
  .post-nav-grid > .nav-item:first-child{ border-right:none; border-bottom:1px solid #e9ecef; }
  .post-nav-grid .next{ text-align:left; }
}

</style>