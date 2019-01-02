<style type="text/css">
.blog-banner-header:before {
  background: url("{{asset_cdn('pintaria/background/image-header-blog.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.class-banner-header:before {
  background: url("{{asset_cdn('pintaria/background/image-header-program-kami.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.video-banner-header:before {
  background: url("{{asset_cdn('pintaria/background/video-1-menit.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.profession-banner-header:before {
  background: url("{{asset_cdn('pintaria/background/image-header-profesi.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.category-banner-header:before {
  background: url("{{asset_cdn('pintaria/background/image-header-kategori.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.contact-banner-header:before {
  background: url("{{asset_cdn('pintaria/background/hubungi-kami.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.forgot-password-banner:before {
  background: url("{{asset_cdn('pintaria/background/lupa-password.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.policy:before {
  background: url("{{asset_cdn('pintaria/background/kebijakan-pengguna.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.agreement:before {
  background: url("{{asset_cdn('pintaria/background/perjanjian-pengguna.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.about:before {
  background: url("{{asset_cdn('pintaria/background/tentang-kami.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.courses:before {
  background: url("{{asset_cdn('pintaria/background/image-header-akunsaya.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.referrals:before {
  background: url("{{asset_cdn('pintaria/background/Banner-Referral7.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.class:before {
  background: url("{{asset_cdn('pintaria/background/image-header-class.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
@php
  $segment = Request::segment(1);
@endphp
@if($segment == 'transaksi-pembayaran-berhasil' || $segment == 'transaksi-pembayaran-gagal' || $segment == 'menunggu-transaksi-pembayaran' || $segment == 'mohon-info' || $segment == 'terima-kasih')
<style type="text/css">
  ul#top_menu li a {
    color:#353535;
  }
  ul#top_menu li a:hover {
    color:#353535;
  }
  header.header .search-box .search-btn {
    color:#111;
  }
  header.header .search-box input[type=text]::-webkit-input-placeholder {
    color:#555;
  }
  header.header .search-box input[type=text]:-moz-placeholder {
      color:#555;
      opacity:  1;
  }
  header.header .search-box input[type=text]::-moz-placeholder {
      color:#555;
      opacity:  1;
  }
  header.header .search-box input[type=text]:-ms-input-placeholder {
      color:#555;
  }
  header.header .search-box input[type=text]::-ms-input-placeholder {
      color:#555;
  }
  header.header .search-box input[type=text]::placeholder {
      color:#555;
  }
  header.header .search-box input[type=text] {
    border: 1px solid #666;
    color: #555;
  }
</style>
@endif