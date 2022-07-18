<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Sistema em Manutenção</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Pagina Facil">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" href="//www.hostgator.com.br/favicon-32x32.png">

    <!-- css group start -->
    <!-- <link rel="stylesheet" type="text/css" href="./FRESH BREAD BAKERY_files/common.css"> -->
    <style>
      /* http://meyerweb.com/eric/tools/css/reset/
         v2.0 | 20110126
         License: none (public domain)
      */

      html,
      body,
      div,
      span,
      applet,
      object,
      iframe,
      h1,
      h2,
      h3,
      h4,
      h5,
      h6,
      p,
      blockquote,
      pre,
      a,
      abbr,
      acronym,
      address,
      big,
      cite,
      code,
      del,
      dfn,
      em,
      img,
      ins,
      kbd,
      q,
      s,
      samp,
      small,
      strike,
      strong,
      sub,
      sup,
      tt,
      var,
      b,
      u,
      i,
      center,
      dl,
      dt,
      dd,
      ol,
      ul,
      li,
      fieldset,
      form,
      label,
      legend,
      table,
      caption,
      tbody,
      tfoot,
      thead,
      tr,
      th,
      td,
      article,
      aside,
      canvas,
      details,
      embed,
      figure,
      figcaption,
      footer,
      header,
      hgroup,
      menu,
      nav,
      output,
      ruby,
      section,
      summary,
      time,
      mark,
      audio,
      video {
          margin: 0;
          padding: 0;
          border: 0;
          font-size: 100%;
          font: inherit;
          vertical-align: baseline;
      }


      /* HTML5 display-role reset for older browsers */

      article,
      aside,
      details,
      figcaption,
      figure,
      footer,
      header,
      hgroup,
      menu,
      nav,
      section {
          display: block;
      }

      body {
          line-height: 1;
      }

      ol,
      ul {
          list-style: none;
      }

      blockquote,
      q {
          quotes: none;
      }

      blockquote:before,
      blockquote:after,
      q:before,
      q:after {
          content: '';
          content: none;
      }

      table {
          border-collapse: collapse;
          border-spacing: 0;
      }

      html {
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
      }

      *,
      *:before,
      *:after {
          -webkit-box-sizing: inherit;
          -moz-box-sizing: inherit;
          box-sizing: inherit;
      }

      .cm-not-in-page {
          left: -99999px;
          position: absolute;
          top: -99999px;
      }

      body {
          background: #ffffff;
          font-size: 14px;
          font-family: 'Montserrat', sans-serif;
          color: #333333;
      }

      .lyt-final-website {
          position: absolute;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
      }

      .lyt-final-website .img-wrap {
          background: url(../images/website-bg.jpg) no-repeat 0 0 transparent;
          background-size: cover !important;
          width: 100%;
          display: inline-block;
          height: 100%;
          position: fixed;
      }

      .lyt-final-website .img-wrap img {
          width: 100%;
          display: none;
      }

      .lyt-final-website .mod-card {
          background: #ffffff;
          width: 820px;
          min-height: 410px;
          position: absolute;
          /* left: 0; */
          /* right: 0; */
          margin: 0 auto;
          top: 50%;
          /* margin-top: -205px; */
          padding: 50px 40px;
          left: 50%;
          transform: translateX(-50%) translateY(-50%);
      }

      .lyt-final-website .card-wrap {
          /* position: absolute; */
          /* top: 50%; */
          /* transform: translateY(-50%); */
          overflow: hidden;
          padding-bottom: 40px;
      }

      .mod-card .card-img {
          float: left;
          border-radius: 4px;
          margin-right: 25px;
      }

      .lyt-final-website .mod-card .card-img {
          width: 125px;
          height: 90px;
      }

      .lyt-final-website .mod-card .card-img.active {
          background: url(../images/websitebig-logo.png) no-repeat 0 0 transparent;
      }

      .mod-card .card-img img {
          width: 100%;
          display: none;
      }

      .mod-card .card-desc {
          overflow: hidden;
      }

      .lyt-final-website .mod-card .card-desc .card-title {
          font-size: 40px;
          line-height: 42px;
          margin-bottom: 20px;
          font-weight: 900;
          text-transform: uppercase;
      }

      .lyt-final-website .mod-card .card-desc .desc {
          width: 100%;
          font-size: 12px;
          line-height: 22px;
          margin-bottom: 16px;
          height: 110px;
      }

      .lyt-final-website .mod-card .card-desc .contact-info .contact-details {
          font-size: 12px;
          line-height: 14px;
          margin-bottom: 20px;
          display: block;
          height: 16px;
      }


      /* newly added */

      .lyt-final-website .mod-card .card-desc .contact-info .contact-details.address-details {
          width: 300px;
          height: auto;
      }


      /* newly added */

      .lyt-final-website .mod-card .card-desc .contact-info .contact-details.address-details span {
          line-height: 18px;
      }

      .lyt-final-website .mod-card .card-desc .contact-info .contact-details span {
          font-size: 12px;
          line-height: 14px;
          margin-bottom: 0;
          display: block;
      }

      .mod-card .card-.powered-by {
          font-size: 12px;
          position: absolute;
          color: #fff;
          text-transform: uppercase;
          bottom: 20px;
          right: 30px;
          font-family: 'Open Sans', sans-serif;
      }

      .powered-by a {
          color: #fff
      }

      .social-media {
          list-style: outside none none;
          margin-top: 20px;
          position: absolute;
          right: 40px;
      }

      .lyt-final-website .mod-card .card-desc .social-media li {
          margin-right: 15px;
          float: left;
      }

      .lyt-final-website .mod-card .card-desc .social-media li:last-child {
          margin-right: 0;
      }

      .mod-card .card-desc .social-media li .cm-icon {
          line-height: 9px;
          display: block;
      }

      .mod-card .card-desc .social-media li .cm-icon.active {
          color: #ffffff;
          border-radius: 50%;
      }

      .lyt-final-website .mod-card .card-desc .social-media li .cm-icon {
          width: 26px;
          height: 26px;
          font-size: 15px;
          padding: 6px;
      }

      .mod-card .card-desc .social-media li .cm-icon.active.icon-fb {
          background: #3460a1;
      }

      .mod-card .card-desc .social-media li .cm-icon.active.icon-instagram {
          background: #3d739c;
      }

      .mod-card .card-desc .social-media li .cm-icon.active.icon-youtube {
          background: #cd201f;
      }

      .mod-card .card-desc .social-media li .cm-icon.icon-fb:before {
          content: "\6d";
      }

      .mod-card .card-desc .social-media li .cm-icon.icon-instagram:before {
          content: "\4d";
      }

      .mod-card .card-desc .social-media li .cm-icon.icon-youtube:before {
          content: "\66";
      }

      .social-media a {
          text-decoration: none;
      }

      .powered-by-anchor {
          color: #fff;
          text-decoration: none;
      }

      .powered-by {
          font-size: 12px;
          position: absolute;
          ;
          color: #fff;
          text-transform: uppercase;
          bottom: 20px;
          right: 30px;
          font-family: 'Open Sans', sans-serif;
      }

      .powered-by-anchor {
          color: #fff;
          text-decoration: none;
      }

      [class^="icon-"]:before,
      [class*=" icon-"]:before {
          font-family: "instaweb" !important;
          font-style: normal !important;
          font-weight: normal !important;
          font-variant: normal !important;
          text-transform: none !important;
          speak: none;
          line-height: 1;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
      }

      @media only screen and (max-width: 768px) {
          /* 13th Sep */
          .lyt-final-website {
              position: relative;
              left: auto;
              right: auto;
              top: auto;
              bottom: auto;
              padding: 40px 10px
          }
          .lyt-final-website .img-wrap {
              left: 0;
              right: 0;
              top: 0;
          }
          .lyt-final-website .mod-card {
              padding: 30px;
              width: auto;
              min-width: auto;
              min-height: auto;
              transform: none;
              position: relative;
              top: 0;
              left: 0;
              /* top: 50%;
          transform: translateY(-50%);*/
          }
          .lyt-final-website .card-wrap {
              left: 20px;
              right: 20px;
          }
          .lyt-final-website .mod-card .card-img {
              float: none;
              margin-bottom: 15px;
          }
          .lyt-final-website .mod-card .card-desc .card-title {
              font-size: 18px;
              line-height: 20px;
          }
          .lyt-final-website .mod-card .card-desc .desc {
              width: 100%;
              font-size: 12px;
              line-height: 22px;
              margin-bottom: 28px;
              height: auto;
          }
          .lyt-final-website .mod-card .card-desc .contact-info .contact-details {
              margin-bottom: 10px;
              height: auto;
          }
          /* newly added */
          .lyt-final-website .mod-card .card-desc .contact-info .contact-details.address-details {
              width: auto;
          }
          .powered-by {
              position: relative;
              bottom: auto;
              right: auto;
              margin-top: 30px;
              text-align: right;
              padding-right: 10px;
          }
          .powered-by-anchor {
              font-size: 10px;
          }
      }
    </style>
    <!-- <link href="./FRESH BREAD BAKERY_files/css" rel="stylesheet"> -->
    <!--
    <style>
      /* vietnamese */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: local('Montserrat ExtraLight'), local('Montserrat-ExtraLight'), url(https://fonts.gstatic.com/s/montserrat/v11/eWRmKHdPNWGn_iFyeEYja4uHZpzeMvIxgxffEGR1vRs.woff2) format('woff2');
        unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: local('Montserrat ExtraLight'), local('Montserrat-ExtraLight'), url(https://fonts.gstatic.com/s/montserrat/v11/eWRmKHdPNWGn_iFyeEYjax3FbGwR6vt0FcFQ55rEhNY.woff2) format('woff2');
        unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: local('Montserrat ExtraLight'), local('Montserrat-ExtraLight'), url(https://fonts.gstatic.com/s/montserrat/v11/eWRmKHdPNWGn_iFyeEYja_bbaTZmtPDRvp9xUdyvPg4.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
      }
      /* vietnamese */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 300;
        src: local('Montserrat Light'), local('Montserrat-Light'), url(https://fonts.gstatic.com/s/montserrat/v11/IVeH6A3MiFyaSEiudUMXE9RVd-_K1mWccr43Mya9Crg.woff2) format('woff2');
        unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 300;
        src: local('Montserrat Light'), local('Montserrat-Light'), url(https://fonts.gstatic.com/s/montserrat/v11/IVeH6A3MiFyaSEiudUMXE1Yo3yjVQ1y6DauKPXl5S54.woff2) format('woff2');
        unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 300;
        src: local('Montserrat Light'), local('Montserrat-Light'), url(https://fonts.gstatic.com/s/montserrat/v11/IVeH6A3MiFyaSEiudUMXEweOulFbQKHxPa89BaxZzA0.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
      }
      /* vietnamese */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v11/SKK6Nusyv8QPNMtI4j9J2wsYbbCjybiHxArTLjt7FRU.woff2) format('woff2');
        unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v11/gFXtEMCp1m_YzxsBpKl68gsYbbCjybiHxArTLjt7FRU.woff2) format('woff2');
        unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v11/zhcz-_WihjSQC0oHJ9TCYAzyDMXhdD8sAj6OAJTFsBI.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
      }
      /* vietnamese */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 500;
        src: local('Montserrat Medium'), local('Montserrat-Medium'), url(https://fonts.gstatic.com/s/montserrat/v11/BYPM-GE291ZjIXBWrtCweiyNCiQPWMSUbZmR9GEZ2io.woff2) format('woff2');
        unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 500;
        src: local('Montserrat Medium'), local('Montserrat-Medium'), url(https://fonts.gstatic.com/s/montserrat/v11/BYPM-GE291ZjIXBWrtCwevfgCb1svrO3-Ym-Rpjvnho.woff2) format('woff2');
        unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 500;
        src: local('Montserrat Medium'), local('Montserrat-Medium'), url(https://fonts.gstatic.com/s/montserrat/v11/BYPM-GE291ZjIXBWrtCweteM9fzAXBk846EtUMhet0E.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
      }
      /* vietnamese */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 600;
        src: local('Montserrat SemiBold'), local('Montserrat-SemiBold'), url(https://fonts.gstatic.com/s/montserrat/v11/q2OIMsAtXEkOulLQVdSl053YFo3oYz9Qj7-_6Ux-KkY.woff2) format('woff2');
        unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 600;
        src: local('Montserrat SemiBold'), local('Montserrat-SemiBold'), url(https://fonts.gstatic.com/s/montserrat/v11/q2OIMsAtXEkOulLQVdSl02tASdhiysHpWmctaYEsrdw.woff2) format('woff2');
        unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 600;
        src: local('Montserrat SemiBold'), local('Montserrat-SemiBold'), url(https://fonts.gstatic.com/s/montserrat/v11/q2OIMsAtXEkOulLQVdSl03XcDWh-RbO457623Zi1kyw.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
      }
      /* vietnamese */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: local('Montserrat Bold'), local('Montserrat-Bold'), url(https://fonts.gstatic.com/s/montserrat/v11/IQHow_FEYlDC4Gzy_m8fcnv4bDVR720piddN5sbmjzs.woff2) format('woff2');
        unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: local('Montserrat Bold'), local('Montserrat-Bold'), url(https://fonts.gstatic.com/s/montserrat/v11/IQHow_FEYlDC4Gzy_m8fcjrEaqfC9P2pvLXik1Kbr9s.woff2) format('woff2');
        unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: local('Montserrat Bold'), local('Montserrat-Bold'), url(https://fonts.gstatic.com/s/montserrat/v11/IQHow_FEYlDC4Gzy_m8fcmaVI6zN22yiurzcBKxPjFE.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
      }
      /* vietnamese */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 900;
        src: local('Montserrat Black'), local('Montserrat-Black'), url(https://fonts.gstatic.com/s/montserrat/v11/aEu-9ATAroJ1iN4zmQ55BqFJzo5GKYqmgW1FmO8t7jY.woff2) format('woff2');
        unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 900;
        src: local('Montserrat Black'), local('Montserrat-Black'), url(https://fonts.gstatic.com/s/montserrat/v11/aEu-9ATAroJ1iN4zmQ55BuQssvi-iD7OeGmZ-9cC-fk.woff2) format('woff2');
        unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 900;
        src: local('Montserrat Black'), local('Montserrat-Black'), url(https://fonts.gstatic.com/s/montserrat/v11/aEu-9ATAroJ1iN4zmQ55Bi0ZNta1KZbpkb8Cqm6Z_co.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
      }

    </style>
-->
    <!-- <link href="./FRESH BREAD BAKERY_files/css(1)" rel="stylesheet"> -->
    <!--
    <style>
      /* cyrillic-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 300;
        src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/DXI1ORHCpsQm3Vp6mXoaTQ7aC6SjiAOpAWOKfJDfVRY.woff2) format('woff2');
        unicode-range: U+0460-052F, U+20B4, U+2DE0-2DFF, U+A640-A69F;
      }
      /* cyrillic */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 300;
        src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/DXI1ORHCpsQm3Vp6mXoaTRdwxCXfZpKo5kWAx_74bHs.woff2) format('woff2');
        unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
      }
      /* greek-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 300;
        src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/DXI1ORHCpsQm3Vp6mXoaTZ6vnaPZw6nYDxM4SVEMFKg.woff2) format('woff2');
        unicode-range: U+1F00-1FFF;
      }
      /* greek */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 300;
        src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/DXI1ORHCpsQm3Vp6mXoaTfy1_HTwRwgtl1cPga3Fy3Y.woff2) format('woff2');
        unicode-range: U+0370-03FF;
      }
      /* vietnamese */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 300;
        src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/DXI1ORHCpsQm3Vp6mXoaTfgrLsWo7Jk1KvZser0olKY.woff2) format('woff2');
        unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 300;
        src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/DXI1ORHCpsQm3Vp6mXoaTYjoYw3YTyktCCer_ilOlhE.woff2) format('woff2');
        unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 300;
        src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/DXI1ORHCpsQm3Vp6mXoaTRampu5_7CjHW5spxoeN3Vs.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
      }
      /* cyrillic-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 400;
        src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/K88pR3goAWT7BTt32Z01m4X0hVgzZQUfRDuZrPvH3D8.woff2) format('woff2');
        unicode-range: U+0460-052F, U+20B4, U+2DE0-2DFF, U+A640-A69F;
      }
      /* cyrillic */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 400;
        src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/RjgO7rYTmqiVp7vzi-Q5UYX0hVgzZQUfRDuZrPvH3D8.woff2) format('woff2');
        unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
      }
      /* greek-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 400;
        src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/LWCjsQkB6EMdfHrEVqA1KYX0hVgzZQUfRDuZrPvH3D8.woff2) format('woff2');
        unicode-range: U+1F00-1FFF;
      }
      /* greek */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 400;
        src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/xozscpT2726on7jbcb_pAoX0hVgzZQUfRDuZrPvH3D8.woff2) format('woff2');
        unicode-range: U+0370-03FF;
      }
      /* vietnamese */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 400;
        src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/59ZRklaO5bWGqF5A9baEEYX0hVgzZQUfRDuZrPvH3D8.woff2) format('woff2');
        unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 400;
        src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/u-WUoqrET9fUeobQW7jkRYX0hVgzZQUfRDuZrPvH3D8.woff2) format('woff2');
        unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 400;
        src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/cJZKeOuBrn4kERxqtaUH3ZBw1xU1rKptJj_0jans920.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
      }
      /* cyrillic-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 600;
        src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/MTP_ySUJH_bn48VBG8sNSg7aC6SjiAOpAWOKfJDfVRY.woff2) format('woff2');
        unicode-range: U+0460-052F, U+20B4, U+2DE0-2DFF, U+A640-A69F;
      }
      /* cyrillic */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 600;
        src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/MTP_ySUJH_bn48VBG8sNShdwxCXfZpKo5kWAx_74bHs.woff2) format('woff2');
        unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
      }
      /* greek-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 600;
        src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/MTP_ySUJH_bn48VBG8sNSp6vnaPZw6nYDxM4SVEMFKg.woff2) format('woff2');
        unicode-range: U+1F00-1FFF;
      }
      /* greek */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 600;
        src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/MTP_ySUJH_bn48VBG8sNSvy1_HTwRwgtl1cPga3Fy3Y.woff2) format('woff2');
        unicode-range: U+0370-03FF;
      }
      /* vietnamese */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 600;
        src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/MTP_ySUJH_bn48VBG8sNSvgrLsWo7Jk1KvZser0olKY.woff2) format('woff2');
        unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 600;
        src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/MTP_ySUJH_bn48VBG8sNSojoYw3YTyktCCer_ilOlhE.woff2) format('woff2');
        unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 600;
        src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/MTP_ySUJH_bn48VBG8sNShampu5_7CjHW5spxoeN3Vs.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
      }
      /* cyrillic-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 700;
        src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/k3k702ZOKiLJc3WVjuplzA7aC6SjiAOpAWOKfJDfVRY.woff2) format('woff2');
        unicode-range: U+0460-052F, U+20B4, U+2DE0-2DFF, U+A640-A69F;
      }
      /* cyrillic */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 700;
        src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/k3k702ZOKiLJc3WVjuplzBdwxCXfZpKo5kWAx_74bHs.woff2) format('woff2');
        unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
      }
      /* greek-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 700;
        src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/k3k702ZOKiLJc3WVjuplzJ6vnaPZw6nYDxM4SVEMFKg.woff2) format('woff2');
        unicode-range: U+1F00-1FFF;
      }
      /* greek */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 700;
        src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/k3k702ZOKiLJc3WVjuplzPy1_HTwRwgtl1cPga3Fy3Y.woff2) format('woff2');
        unicode-range: U+0370-03FF;
      }
      /* vietnamese */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 700;
        src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/k3k702ZOKiLJc3WVjuplzPgrLsWo7Jk1KvZser0olKY.woff2) format('woff2');
        unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 700;
        src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/k3k702ZOKiLJc3WVjuplzIjoYw3YTyktCCer_ilOlhE.woff2) format('woff2');
        unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 700;
        src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/k3k702ZOKiLJc3WVjuplzBampu5_7CjHW5spxoeN3Vs.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
      }
      /* cyrillic-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 800;
        src: local('Open Sans ExtraBold'), local('OpenSans-ExtraBold'), url(https://fonts.gstatic.com/s/opensans/v15/EInbV5DfGHOiMmvb1Xr-hg7aC6SjiAOpAWOKfJDfVRY.woff2) format('woff2');
        unicode-range: U+0460-052F, U+20B4, U+2DE0-2DFF, U+A640-A69F;
      }
      /* cyrillic */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 800;
        src: local('Open Sans ExtraBold'), local('OpenSans-ExtraBold'), url(https://fonts.gstatic.com/s/opensans/v15/EInbV5DfGHOiMmvb1Xr-hhdwxCXfZpKo5kWAx_74bHs.woff2) format('woff2');
        unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
      }
      /* greek-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 800;
        src: local('Open Sans ExtraBold'), local('OpenSans-ExtraBold'), url(https://fonts.gstatic.com/s/opensans/v15/EInbV5DfGHOiMmvb1Xr-hp6vnaPZw6nYDxM4SVEMFKg.woff2) format('woff2');
        unicode-range: U+1F00-1FFF;
      }
      /* greek */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 800;
        src: local('Open Sans ExtraBold'), local('OpenSans-ExtraBold'), url(https://fonts.gstatic.com/s/opensans/v15/EInbV5DfGHOiMmvb1Xr-hvy1_HTwRwgtl1cPga3Fy3Y.woff2) format('woff2');
        unicode-range: U+0370-03FF;
      }
      /* vietnamese */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 800;
        src: local('Open Sans ExtraBold'), local('OpenSans-ExtraBold'), url(https://fonts.gstatic.com/s/opensans/v15/EInbV5DfGHOiMmvb1Xr-hvgrLsWo7Jk1KvZser0olKY.woff2) format('woff2');
        unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 800;
        src: local('Open Sans ExtraBold'), local('OpenSans-ExtraBold'), url(https://fonts.gstatic.com/s/opensans/v15/EInbV5DfGHOiMmvb1Xr-hojoYw3YTyktCCer_ilOlhE.woff2) format('woff2');
        unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 800;
        src: local('Open Sans ExtraBold'), local('OpenSans-ExtraBold'), url(https://fonts.gstatic.com/s/opensans/v15/EInbV5DfGHOiMmvb1Xr-hhampu5_7CjHW5spxoeN3Vs.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
      }

    </style> -->
    <!-- <link href="./FRESH BREAD BAKERY_files/icons.css" rel="stylesheet"> -->

    <style>
      @charset "UTF-8";

      /* instaweb */
      @font-face {
        font-family: "instaweb";
        src:url("https://file.myfontastic.com/pqmQ7Jz4TZqwK4jFaaJPtC/fonts/1501563339.eot");
        src:url("https://file.myfontastic.com/pqmQ7Jz4TZqwK4jFaaJPtC/fonts/1501563339.eot?#iefix") format("embedded-opentype"),
          url("https://file.myfontastic.com/pqmQ7Jz4TZqwK4jFaaJPtC/fonts/1501563339.woff") format("woff"),
          url("https://file.myfontastic.com/pqmQ7Jz4TZqwK4jFaaJPtC/fonts/1501563339.ttf") format("truetype"),
          url("https://file.myfontastic.com/pqmQ7Jz4TZqwK4jFaaJPtC/fonts/1501563339.svg#1501563339") format("svg");
        font-weight: normal;
        font-style: normal;
      }

      [data-icon]:before {
        font-family: "instaweb" !important;
        content: attr(data-icon);
        font-style: normal !important;
        font-weight: normal !important;
        font-variant: normal !important;
        text-transform: none !important;
        speak: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }

      [class^="icon-"]:before,
      [class*=" icon-"]:before {
        font-family: "instaweb" !important;
        font-style: normal !important;
        font-weight: normal !important;
        font-variant: normal !important;
        text-transform: none !important;
        speak: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }

      .icon-left:before {
        content: "\63";
      }
      .icon-right:before {
        content: "\64";
      }
      .icon-twitter:before {
        content: "\65";
      }
      .icon-youtube:before {
        content: "\66";
      }
      .icon-wordpress:before {
        content: "\67";
      }
      .icon-phone:before {
        content: "\68";
      }
      .icon-user:before {
        content: "\69";
      }
      .icon-next:before {
        content: "\6a";
      }
      .icon-times:before {
        content: "\6b";
      }
      .icon-upload:before {
        content: "\6c";
      }
      .icon-fb:before {
        content: "\6d";
      }
      .icon-currency:before {
        content: "\6e";
      }
      .icon-google:before {
        content: "\62";
      }
      .icon-credit-card:before {
        content: "\6f";
      }
      .icon-smartphone:before {
        content: "\70";
      }
      .icon-social-media:before {
        content: "\62";
      }
      .icon-bank:before {
        content: "\71";
      }
      .icon-check:before {
        content: "\72";
      }
      .icon-delete:before {
        content: "\73";
      }
      .icon-link:before {
        content: "\74";
      }
      .icon-curve-arrow:before {
        content: "\75";
      }
      .icon-hour:before {
        content: "\76";
      }
      .icon-plugs:before {
        content: "\77";
      }
      .icon-error:before {
        content: "\78";
      }
      .icon-bell:before {
        content: "\79";
      }
      .icon-settings:before {
        content: "\7a";
      }
      .icon-help:before {
        content: "\41";
      }
      .icon-down:before {
        content: "\42";
      }
      .icon-search:before {
        content: "\43";
      }
      .icon-switch:before {
        content: "\44";
      }
      .icon-up:before {
        content: "\45";
      }
      .icon-shopping-cart:before {
        content: "\46";
      }
      .icon-balance:before {
        content: "\61";
      }
      .icon-cheque:before {
        content: "\47";
      }
      .icon-upi:before {
        content: "\48";
      }
      .icon-plus:before {
        content: "\49";
      }
      .icon-minus:before {
        content: "\4b";
      }
      .icon-step-microsite:before {
        content: "\4a";
      }
      .icon-proceed:before {
        content: "\4c";
      }
      .icon-instagram:before {
        content: "\4d";
      }
      .icon-down-arrow:before {
        content: "\4e";
      }


      .button-contact {
        touch-action: manipulation;
        display: inline-block;
        cursor: pointer;
        border: 0px;
        padding: 0px;
        font-weight: 400;
        color: #337ab7;
        border-radius: 0;
        box-shadow: 0 0 black;
        font-size: 14px;
        background: transparent;
        user-select: none;
      }

      .button-contact:hover {
        color: #23527c;
        text-decoration: underline;
        background-color: transparent;
      }

      #site_main_content{background: rgba(255,255,255,0.9)}

    </style>

    <!-- css group end -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/vex-js/2.3.3/js/vex.combined.min.js"></script>
    <script>vex.defaultOptions.className = 'vex-theme-os';</script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/vex-js/2.3.3/css/vex.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/vex-js/2.3.3/css/vex-theme-os.min.css" />

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
<h1 class="cm-not-in-page">Sistema em Manutenção</h1>
<main>
  <div class="lyt-final-website">
    <div class="img-wrap" style="background: url(painel-festa-2x1m-bombeiros-temas-infantil.jpg) no-repeat 0 0 transparent;">
      <img src="painel-festa-2x1m-bombeiros-temas-infantil.jpg"  alt="">
    </div>
    <div id="site_main_content" class="mod-card">

      <div class="card-wrap">
        <div class="card-img active">
          <img src="data: image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxISEhUTEhIWExUWFxUbFRgVFxcSFRcWFRYXFxUWGBUaHiggHRonHRgXIjEiJikrLi4vFx8zODMsNygtLi0BCgoKDg0OGxAQGy0lICUtLTAwMC01LS0tLS4tLS0wLS0vMC0tLS0tKzcvLS0rLS0tLS0tLS0tLS0tLS0tLS0tL//AABEIAOEA4QMBEQACEQEDEQH/xAAcAAEAAgMBAQEAAAAAAAAAAAAABQYDBAcCAQj/xABEEAABAwEGAwUFBgMHAgcAAAABAAIRAwQFEiExQQZRYRMicYGRBzJSobEjQmJyksGi0fAUMzRDgrLhU3MVFhckk9Li/8QAGwEBAAIDAQEAAAAAAAAAAAAAAAQFAQIDBgf/xAA8EQACAQMCAggFAgMGBwAAAAAAAQIDBBEhMQUSIkFRYXGRofATgbHB0TLhFDNCBiNSYnLxFSQ0Q1Oisv/aAAwDAQACEQMRAD8A7igCAIAgCAIAgCAIAgCAIAgNK9ryp2emalQ5aADVzjo0dcj6ErlWrQowc5vQ7UKE681CC196mK4rY+rRbVqQDUJc1o0ayYaJ1OQmebjoIShN1Kam1jOv4FxTjTquEXnGnzW/qSIK6nE+oAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgOZ8cXwKtoNMHu0Zb0Lz758sm9MJ5rznF6rqTVNbL6+/ueq4LbfDpfFe8vp+/4PF38UvYwMIxBraYptGWTGhjs4y0xeLiFKt+JwVJ8+nLypLren7eRDu+EzdVcmvNzNvqWuV6PHidAuq1CowOBkEAjwOauU8lE1h4ZvoYCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgK3x3xGLFZ5aR2tSW0hy+J8cmg+paN1xrVOSOVuTuH2n8TV5X+lav33/v1HFP7fnmSSTqcyTrJPNUkqDerPZ6RSS06kb1mtqiVbc3LfwvxJgIpuMRAE8iYb+w8V6KzqqpRj2rR+J4niFvKjcSTWjba8H+Dplkq4mgqUQTMgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCA1LxvGnQa11R2EOcGjqTJ+QDj4NKw2lubRhKWyODcbcUG2mi8nMMqy34cVeoWt8ezFLNRZP4mGeu4daO1c4Pra+enV82yt02PdmNvqucpQjoywmur33GWha41WlSinsbN4WSasNoDon+uY8P5KtqwlDKi9zR04VOVyWq9HszqHB/Ecs7N57zYgndp0Pjt5dVb2Fy61PpbrR/k8jxO0VvW6P6XqvuvfUXWjVDhIU0rjIgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgOZe2Ws6bOyYEVXf6u4AfIE/qUK8k04rxPQcCpxl8RvuXnn8I5VZrN2jnNGsZeMrjUqfDgmX1SWJJ++otPDl14qIJGcvB5yHER8gqO+uuWq9ez6HGrWXO8e9CGtPDz2udPuiM9JJaCY6Ak5/8qwpcRhKKxuzpCtzQUWaFhrQY5E/VS60FJZOlOSa07ScpW9zHMc3QTJ8SIHyK58PahUlF7vHpkpeOU5ShGSWkc5fjhJe+w7Fwlb+0piVcHmSxoAgCAIAgCAIAgCAIAgCAIAgCAICOvG/LPQqMp1aoY+p7oM6aS4gQ0TlJic+S0lOMWk3ubxpykm0tiQJjM5Lc0K0eKnT3aDSJOEmoWkjYkdnkY22QE5YbYKlNj9MTWuiZiQDE9EBtIAgKH7XbvL7PTrAT2TyHdG1IE/qaweah3kcwUuxlzwSsoV3B/wBS9V+2TjtjrdnWDjp978p38tfJRqsfiUcdfUejrSWi9+/udV4fDCNs8z1yAn0AXib3mTKmvlao+cQWRsGEs6ryb21Rvc5Ze9IMq667aADQZeS9paTc6RaU9/fvqMdW2ThYNjJ+gCk2tDE3NlHxu6TSox7cv5dX57NDr/s8rEsCnHnjoQQGne1t7GkagGIgtAExOJwbrB5z5ICIs3ExL2h9NrWkgFweTE5AxhGUxOeQk7ICfNdoBJIAAJJJgADUk8kBqXTfNC0hxoVA8MMOyLSDsYIBg7HQwVrCcZ/pZvOnKH6kb62NAgCAIAgCAIAgCAIAUBxS87utb7S+naR9sTLn5mmW6B7T8GUBuuUZQYqZW9WdZ823b3e+ouI3NGFBcvl1599ZYqFN1OmWU3uzaGuxEuxtGWF3SMhHugwMslapYWCoby8mtar1ZTBmcQ1boRyJOkdd4MTBWTBh4e4oc54YDlJ8MyTHzQHULDVxNBQGwgNe32ZtWm6m9oc1wIcDoQdVhpNYZmMnFqUd0cCt1zmlWeMUFjnNgidCQM8py3jOVR1KvI3Ta6z19O5dSnGT10NuzX6+iIDQ6OuFV9WyjWeW8HCpUXYebXxq92Roj9f/AOVinweMdVP0/cjq45HsQFrd2zsUYSTn97yVtQXwljckwv8ADzy+v7GCx2curYZmDHLyVnRS5E8Hn72tKtWcpP8AZdh3Pgi78FMLqRS3oDQvqwmtTwh2EghwnMGARB6Z67Za6ICjWkkONIt7+7ToAcsRdphOcbnPkYA17dYTVplrqji4gDGSZMZgOA1ZInD565rSpDni4m9OfJJSIC57ZVstpbhOBzSBVn3ezJ7w6yPd6wdiq63pVoVu7r7GWlzWoTo9727UdVua+W1hkVaFQTSAIAgCAIAgCA81agaC5xgAEk8gMyUBU7Df1Rj3OqAua8yWyJZsA2TEAAAjLQnUmQJhvEdnjNzh07OpPyagK5fttFaoH02YYEHFq8AkgQMmxJg9c4QGlTqBwkeY3B5Ec0BU+MLX2gDKYDiw952/Itbz6+HMKLK7hGpyefcS4WdSVPn8u8kOA7oDiHKURDrllpYWgIDMgCA5Vx3dVV9td2DC/ExhdhgAP7zSC4iAYa3UhVV3bynVzCPV760W9ncxhRxOXX76mRbPZ9b6m9Fn56hn+CmQtoWU1u0Ynf03tn0NK3ezO3szxUHdG1HT/FTA+a7K2klucHdQfaQdqui00P72k5g+LIs/WAW/NcZ05R3R2p1Yy2Z84SpYqoPVWaWNCqbzqfoC4aWGmPBASaA1L0vClQpuqVXBrR5knYAbk8lrKSisvY2jFyeI7nNLFfTa1WpLSwve5zMRxEg7E/EBtyAAmJUejdRqycdn9SRXtJ0oqW6+hv1akZak6DnzPQdf3IClEUqnElzWt9TtGOFRsAYW90sA2AJ7wmTMznogLTwaDRaO0DweWB0+pEepQFpbebzUa892mO6W691xzc46SDB5AA85QE2yu06FAZUAQBAEAQGnewmk4fFhafBzg0/IlAV202NAR1SiQgMSAovF991WWh9Oi8shjWOiJlwxTOxhwg7Z80BHXdajAbUEcjsf65KlubV0nzR2L21u1VXLLcsNw3u6y1MQGJhPebv+ZvXputrW65OjLb6Gl3Z8/Sjv9Todo4lFSm3sHe9q8bD4RP3ufLx0t001lFM008Mxs4htAESx3VzDJ8cLgPQBZMGvaL1qvk1KuFu8EU2jxIzjoSUC10IO28cWSziKc1nDQU8mebzlHgCo87mEe8t7Xgl1X1a5V2v8b/QhqntVtQP2dGi0fiD3n1Dmj5KO72XUi5p/2apJdObfhhfkxf8Aqha3H7SlRcPwh7D64iPkivJdaE/7NUWuhNrxw/wWLh3jyyVThrTQcdcfepmdsYGn5gApELqEt9CouuB3VHWK5l3b+W/lkszeFLA+K1BjWE546BAYd5wiWeYEqQU7TTwyUYXsbhDxHPD3vUuInyQwatrv0Wam59XE9o0LRLiSYDTsJJyJgbGMp1nNQi5PqN4Qc5KK6zmF/X3VtdTtKphonAwHusHIczzdv0EAUde4lVf2L63to0l9yIc+RjJLWDNsGHOIzBB2HX05qVaWjyqkvkRby8WHTh8yb4NvGpWqVhUJcThc0nkJaRlkB7uQ3JO5VoVBcqNBAb9GzoDaqWWWOB0LXT5goCo8H8SGs4SdYQHSqTpAKA9oAgCAIDFaaWNjmzEgieRIyKA0hSD2hwETqORGTm+RBHksGSOtNjWQRdoskIYOYX7YT/4jUDvvdm4dQWNbPq1w8kB0CxcKU6tCC2ZCw0msMym08orbeHajKxpOM0xni+9GzY+Lr59DXOwXxMp9H3oWS4i/hYa6XvU27/vhlkphjAMZEMbs0aYj0+p81LrVVSjp8hw3h072rr+lbv7Lvfpv40oX5av+vU/Uq/8AiKnaew/4PZf+Nev5NG0WipUze9z/AMzi76rSU5S3ZLpW1Gj/AC4JeCMBatDufIQHxAEBsWO3VaRmlVfTJ1LHOYfVpW0ZyjszjVtqNb+ZFPxWSTfxbbyINqqx+Yg/qGa6fxFTtIa4RZJ5+GvX8nROEuJ222kadWO2a2HtIEVG6FwH1HXkVYUKyqRw9zyPFOGys6mY/oez7O59/Z2+ZV+Kbr/sz8Rl1A+4NYd8DzuOXPfQzyhZU4TcvQj1L6pOCj6kZY7LUtT94UwhHQLkuEUHNyzLDPg5zcP+13ogLJRs6A36NnQERx/erbHYKz5h72mnSG5qVAQCBvhGJ/gwoDmXs8BxhAdysnuhAZkAQBAEAQETbKxoPL4LmO98DUHTG3mYgEbgDcQQNmjUp1m46bg5p3HPcHkehzCwZNW02NZBVuIuHBWwvb3ajPdOxB1a7p129QRgmeGLYINJ3deyAQcwCdMxkfCZ0mJCAgLU54DzGKoMUgn3qgmQT4iFh9xmOG1zPCOV2uu+q8veZc7X+UbAaQqac3KWZH062t6dCkqdLb69/wAzAWrQ7nwtQHktQwZbFYn1qjKVMS95AaP3PQCSegK0qVI04OctlqcbmvGhSdSWy9pH28bvfQqGnUEOEeBDgHNcDyIIK7TjyyaOdndRuqMasevddj6176jULVoSj5CA+IDNZLS+k9tSm4tc0y0jY/y6braMnF5Ryr0YVqbp1FlM69aagqWXFamAA0sVVuw7uIxyI+R33V0s41PmVRRjNqDysvD7V2kbwC5pHdaHOA3IH/J8QPRZNC90LOZJJknU6dIA2A0A+pkoCQo2dAYb7vqzWKn2toqNpt+6Dm55icLG6uPQIDgvFvE1a87QHkFlJsijS1wg6ucRkXmBMZCABMEkC8+z25iIcQgOp02wAEB6QBAEAQBAYrTRDhBQFFvu46tJ5q2eo+k7csJbMaBw0cOhlAV208WXtRGEup1Or6TZ/gwj5ICvXlxNedfJ9YsadW0mikP1AYv4kBP8GVqzCBBhAWy9aRDw/Z4/iAAPqIPk5Acy4osHZV3QO6/vjxPvD1z/ANQVXdQ5Z57T3nAbr41ryPeGny6vx8iHLVGLo+FqA8lqA6N7NbhwMNqeO88EUp2Z95/+oiB0H4l5vjl28qhHbd/Zffx8Dx/G734tX4Mdo797/bbxybHtFuDtbLStLB9pSpMxxq6lhBP6TJ8C7or24uVC6+HL+rbx/f64OHA734FX4cn0Zej6n9n+xywtXc9ufC1DB5LUBNcHXX29qYCJYzvv8G6DzdA8JUi2hzT8Co41dfAtWlvLRff09cFk9pl64KbaDT3qpl3RjTp5ujya5Wp4E1+A7O4xlI/rMdUBcb3vW02cfZEno8B49T3vmgKdefHN7O7rajaXWnSbPq8O+SAq77utFoqY6rn1XnV1RznujWJO3TQIC48McGkkFwQHV7pu5tJoACAkUAQBAEAQBAEB4qUgdUBGWu46b9QEBH/+VKU+6EBIWO46bNAgPnEFjBoOI1Z3h/pzPq3EPNAcx40s80mv3Y+PJ4g/MNUW8jmnnsL7+ztbku+Tqkn5rX6J+ZTS1VZ7ks/DPDFG008b6tTLJ7aTWyw7AzLjPMNj5qqv+IVLefLCK7nJvX6L5c2fQ83ecWuqFR03BLzeV2rb6Fuu/g67xoztXDXG9ziPzMkAHxCpK/Fb7rfKn2Jej19GVc+J3VTeo/lp9MFgs4wgUojC37PkabcsP5m5DqIOecd69RcQt/jf9yH6u9f4vz3+KKlrlZjrvxU6VJpzNNhcfhYWgT4nMDwJziDO464xq80u3Rdr/C6/LryYpR5iEtfBlgdrRDDtge5vo2Y+SrKHFL5/pfN4pfXT6lvDiNzT2qP56/XJWuIuDbJZ6TqvbVWAe6HYXYnbNAgOJV1Y8QqV58k4rv5Xsu3rX/tnuLG14td1ZqmoqT+a8/8AYoZarU9KX/2b2TDRq1Yze8NHgwTl5uPorKzjiDfaeM/tJW5riNPqivV/skVDiG0G02+qdQ13Zt8KfdPlixHzUs86dX4EukNYCQgLZarsY8ZhARVXhWkT7oQGazcN02/dCAl6FlazQIDOgCAIAgCAIAgCAqF9drTtDnuxsY59MU6mP7Id1vdcxrgZLgWiQG945y6Hed4o7yhV/iKbbprDaT3/AAu3fL9JNLllHl0zqTllvdrjhcMLt2nPzafvN6+oByVtZX1G8p89J+K614+8HCcHF4ZJNMqYan1AeatMOBadCCD4FAco4gbNkqTqGtJ8Wlrv2XKus05eBP4XPkvKT/zJeen3KEHKnwfRuY3rovOpZqgq0jmMiD7rm7td0+i4XFvC4punUWnqn2ojXlpTuqfLLfqfZ+3avvhnUruviz2qm14GI7swl9Rjt8mgkfmGS8lUsLmhUcI+eya+enyPFXNGVCbp1VqveV3e9zNa7PWwSzEwg/Z9q4O7+cERLtJkFwymREhWVrZyof8AMVpRSW+N3/lxpHXb1z1kOUlLooXXQqdk01DJIGLAcOeEQTOcQABB0A6rPFIKrN3EZJpvHSTfLj+nrXmuvOdRTkksC8L0oWam6o84QNoIe47AA5uKqoWtzczUM5XbnMV5aLw8kS6FN1pqFNZbOTcQXzUtdTG/ICQxg0YP3PMr11rbU7anyQ+b62+38LqPaWVlC1hhat7v31EWWqQTDpnBjcNipk79o4//ACOj5AK2tlikj57xmXNfVPFLySRz3hSkatUOOrjJ8SZK7lWd/uGzhtMeCAlEBrW22tpgTm4zhaPedGvlmJJyEjmo11d0rWm6lV4X17l3m0YuTwir46prtd3nAVAajmv+zY094sIccyAAJaMw6CBMqi4dWu7y4/idY0svRvsWNO1dum/Wd58sI8vWWSz3g15gFemIxuoAgCAIAgCAIAgNO9LMKlNzSJBBBB0IOyw0msMFMovLHiz1ydZoVfvZbT8YHk4c8wvF8SsavDa38VavC96PtXvvJ1OSqrEtyfsF6OY4U62p91w91/To7p6TnF9wvi9K9jjafWvuu1eq9SPUouGvUTzHg6K3OJ6QHLeIB/7av0p1Pk0rSp+h+DJNk8XNN/5o/VHMhUVRg+iKR7FRYwbqR1T2Xsw2R7zo6q8+TWtb9Wn1VJfvN1GK6or6s8dxyfPdNdiS+/3LQ5xccR8AOQ/md/LkqS/vfjSUI/pj6vt/Hd4sgU4cqDGuaxrmie62R8QjTx5H9pVhKM7WvONRZpzbyuzXdd69VoRtyt+0SmHWIvGbQ+m4HTV2CCNjLoIWbC2dtfcm6lF4fat/sW3BZ4vIfP8A+WcsLV6I90fC1AdHuUxYKfSk4/7irmj/AC4+B824m83lX/U/qU72f0pe3yXUgnebA2GBAYLxvMMOBgxVOX3Wzu/9hqegkit4jxOjZQzPWT2XW/wu/wAsnWnSc/AgK9Y4iMcvIBqVDBwNziBoN8LdNTznytpb3HGbj4td9BeXgvv5vUkylGlHC997Iq8b1GVKlkBpvvJJO5Jkk7kr3UIRhFRisJbEJtt5ZL8NWR+rlsYLYEB9QBAEAQBAEAQBAQ1/3O2swgjwIyIIzBB2IK1nCM4uMllMym08oq9kt8YrNa/eaO66MqjZgFo+KYGEZyRzE+A4nwurZVlUo5xnR9n+3aWFOqprPmiQs941LMaYqVJD3QGOwkgfnGZIykkkEkDUgm64Pxe4u6/w5RTilq9sPt+e2PnphnGtSpxjlaMtNmtTXjIr05EObcQ/4a0f9qr/ALStKn6X4Ei1/nw/1L6o5OKiq8HvVI9iosYNlI6Lc3F1msljo086tQNLixmQDnOLu845CJ6npoqe74dVr1ZNSUU8LO7xhaJd73y1pp2nn6tjWuLmc8YWd33aeP2IK9+NbVXkB3YsP3acgx1fqfKF2tuF21DVRy+16+my8s95Z2/DKFPWXSfft5fnJ9uXjS12eGip2rB9yrLxHJrpxD1joptSEaixNZFzwi2raxXK+7by28sE7enGdC02WtTLHUnvb7h77e0aQWuY8c4AIIGx2Mx6NooNLdLLXas7rwf18Sqp8LuLW5p1F0oqSy12Z61vt4rvKSHKRg9hzH1DbJ0G6v8AAM/7Tvo5XFH+XHwPm3E/+sq/6n9Ss+zsd9vkupBOn1L1qPe+nQqtaaYGkOxEgYiXEGIMty0IkzOFed4zxWvZVIqMei1vvr+2+Osk0acJRy9yNtd6MptDKf8AeOmcWZb8bqhmcj1zJGecrzVpYV+I3DlUem7fv0X4JM6kYRz5Irduvf8AyqRJky5x1c46uPX6AADIBfQqFCFCmqdNYSK+UnJ5ZP8AC1yF0PeupqX2hRDRAQGVAEAQBAEAQBAEAQHwhAVbjG4+1YKjHim+kcbXGMOhBDuQgnMaddDHuraNxSdOWzN6c3CWUUSpaXVHHtTidpMdxwGzZ218czmtLKypWlP4dNeL7WKk3OWWTPD98mg4B7iafM5lv5ubeu2/MSzQwX2C6x1y3OaLzlnPdk/Jaz/SzvbNKtBv/EvqcebUVbg9qpGQVFjBupHsVFjBupGQVFjBspHsVFjBupHsVFjBupGQVFjBupHsVFjBupHRrj/wVOcvs3ehLiD6Zq2o/wAuPgfPeJtO7qNf4mVnhi76lOmC+WEj3R70fiO3h67hdSCTNO0mm4Oa7AWz3sJLRzaQMjO4JHOQQFHurWnc0nSqLKfo+1d/vY2jJxeUVu3XrUqVHGZL4nDpDZwid9TmudjZxtKXw4vJtVqc7yW7g24C8hzgphzOo2OzBjQAgNhAEAQBAEAQBAEAQBACUBz69Le62POcUGnuDQED/Md13E6CNDKAib0r0qLf7vH+Z2DzGRPrBQERd190ar+zc00nH3CTiaT8JdAz6kAHx1w3gyk3sWW56oYeyfln3Z0IP3fHl5LJgg+IfZf2hNSxObTJzNJ8hn+hwBw/lIjqBko86CeqLa24pKC5amq7ev8Acod88MW2yZ17O9jfjAx0/wBbZaPMrhKlJbot6N9Rqfplr36ESKi54JikexUWMG6kZBUWMGykexUWMG6kSV2XTaLRnRovePiAhn63Q35raNKUtkca1/Qo6Tks9m78kW65uBy0h1qcDH+WwyD+Z37D1UmnapayKW747KS5aCx3vf5dnj9Cy1W4/smaaOjQAfd8do2HkpZ54rt58UWek80mMdUgCXA9m13RjoJI/EB4HdaxkpbM2lCUd0ZLv4nstUim+maE5NMh1PoC6Bh9I6hbGpktt0MpVRULYE9//wC38/XZAdH4eawMGGEBNoAgCAIAgCAIAgCAIAgIviiqW2SsRu3D+shh+qAor7QKdAHm6D5Nc4fMBAU61Wk1XEuJPIf1oFyq1o0lmR2o0J1ZYiYS1rASQJ/bl4KkrV513rt2F7Qt4W8dN+0stIivY6b3Z42ua6dwHOpz5gT5q8otuCb3wUNZJVGltkhOH+NrfZT2T8Noa2Mqk44gEYagzzEHvYtV0ORe7H7RrNVAbWY+zOPx9+lnt2g0HVwAQELxFwFQtcvs+GjUOYLR9k+c+80aT8TeehXKdJSJ9tf1KOj1XvY5Zfd0Wix1OztFM03bE5tcPiY7Rw8FFlBx3L6hcwqrMWfLou6taqgpUKbqjzsNAObnHJo6laxg5PCOlW5hSjzTeDrXDPs8o2YCpacNerrB/uWeAPvHq7LoNVLhRUdXqyhuuJ1KvRh0Y+r8fx9TzfXtAslIllKa7hl9nApjp2hyI/KHLsVhVn8UWy2uNNkWdmFznmnJeGNGf2hzGZABaAZIQFmvmv2Fie4ZSWM8GvcA71EjzXG4cvhvl3O1vy/FjzbFSr0GVW558juD0VJSqypS0L+tRhVjqSfD12Uap7N0B+06O8OvRXVG4jVXeUVe3lSfd2lrtFkw0ezd3sHdk7tgFv8ACQPJdyOavBN8uBDHGYy9EB0+i+QCgPaAIAgCAIAgCAIAgCA073snbUalMauaQ2dA6O6fWEByC87eDTNGDiDsz8BbIcCN3e82NvKDEuLqNLRasmW1pKrq9F72IjusH9SVTTnKpLLLyEI0o4S0MNhsz7TUAa3FyboI+J52pj56Cd7K1tdOaRVXd22+WJcb2qNpUm0w7QNYDpLnGJjqTPRWRWEDb7I0PZUjIQ13h90/t5jkgLZZeG6demCANEBqso1rtcMBDqZJ+ycTB5lkSWnqBGeYQFuDrHedn7KrTDspdTqQKjDEYmkHIifead9dlhpPRm0Jyg+aLwzXp0LJdlHs6TAwa4W96rUI3JJzPVxAGmSJJLCM1KkqkuaTyzk3GPE1stTzSew2ekdKQM4xze8e/wCA7o6kSsmhr3Jwy+qRkgLldNyspMqAavBbP4QCJ9ST1EIDa/s7bVZn0CQ0uEA6htRhkTGoDmwekoDn7KNayvNOqwtw6g7DYg7t5OGSrru1z0olnZ3mOhMkQQQCD4RkQds+arYycWWk4KSJmlxG7syyr3iJIfuSdn/TFy10k21vdKfRluU1xaOHShsaXDzoriDOimkE7Vdp7gQG2gCAIAgCAIAgCAID44xmcggOdcW8bl80bI6G6OrDIu5imdh+P02Krrm8x0Yef4LK1ss9Kp5fkornBokqqbcmXCSijXu+tRqVJq1GBjT7jnBuMjmD9366K0tLX+qRU3l5l8sSw1OJqFNuGm5kbNpYSP4ch5wrIqyDvC2mtmfIDaevPr/RAl7I/tKQxjMiHjTOM/XXzQExw7fps7XMd3ntyaNA46gnpGZ8xqgPIbUrvL3kuc7U/QAbAbBAfat42egfec57f+lmWn80gT5rhVuadJ4k9SRRtalVZitDWp8VWKq443VKbic3VgIPi9rnADxgBZhXhPY1qW84bmxed2Nc3QOaYIIz8HA/uuxxNq5ra1tM0wIq6AjLunWoORAy6OI2KAW6t2dMkZbN6Hw6DPyQFOsV81GViWNxMMS3fLIEHnAAz1gIC1M4hoPaG1cBHw1mjzydkfJAVG+n0aVXFQe003nNjSCKbukaNOw200gCtu7VPpRLSzu2uhIAgiQq2MmnhlpKKayjNc1ZtCqHEd2c426gcunpyNnb3WOjLYqrm0z0obnbLptLXMGEgiBorErDfQBAEAQBAEAQBAEBzj2m3vU7QWVpLaeAOfGWMuLgGn8IDdNyeirr6s10EWVhQUumyjEgCSqpvLwi4SSWWQd52+ThHmrG0tsvmexW3t00uWO55uu6XVjkFalOWahwVU5ICw3NwWZBcEBJ8SXH2DWVGjL3X/Vh+o82oCuupjEHRthJ/CTPyPylAZeJLy/s1JrG5OeCTzDRlHmfoeaAqdiqlzHl25keEAfsqe/X97Hw+7Lrhz/uZeP2RC2z73l9Qu9sukjhdPoyLhwDbHgGg8k03Sac/ccASQOTSJMcx1KsSsJycFVp/EAfB5DfrB8kBEcX3qA/sWnNo735nZ+obH6igN/ge5u0zcEBZL74PDhLQgKfbODKhkQYQEDaLPVsdTs6oMH3TsR/Pn/yFUXNvh6FzaXOVqe7Vb6bBJdJOgGZ/wCPNcKNGpN6L8EivWpQWW/l1lu4C4hMNZOQAAV5FYikUEnzSbOr2apiaCtjUyoAgCAIAgCAIAgIHim4aNpbie0h7RDXtMOA1g7EZnIjcxC41aEKqxJHajcTpPMWcW4ksVak4tycNjmPUf8AKhxsOWW+hNnxHmjtqQN32B73xBzKsYxUVhFdKTk8s7JwVw6GtBIWTUvLLI0bIDK2mBoEBr3rYhWpPpu0cCJ5HYjqDB8kBy+lSLXlrxBaSHDaQYPiEBWeOqLv7VSBnD2LQ3XPDUqEmecOaDvlO4QGS22Ts6bfxMHyJ/mqviC6cPn9i34a+hNeBVbRqfzD6FdbZdL5HG7fRfiX3hCgOzB3lseRBPyB9FPK42L1tAYHvOjROWuXLqgKNYQ+0Vy92Ze4k+ZmB0GnkgO6cH3d2dMZICzFoQGI2ZvJAQnEdw06zCCxruhAInzQJ4OUXpwa4P7rYHQICy8JcKOpkEhAdNs1PC0BAZkAQBAEAQBAEAQHl7JEICu3xw0yrsgIu7+DWMdMIC42SzhggIDOgCAICjcaXd2dQV2jJ0B/R2jXeY7vk3mgIa87uba6TRIFRhxU3HSfvNP4Tl5gHOIQEDxLIp0muaWuDagcDqILI8Rmcxlkq6/WsH4/Ys+HPSa8PuUtlIvfhaC4kmA0FxOmgGZ1XS1WvyOV29PmdFumzOoUh2mToybrhnntP08yppBIbiS0dwt3OZ8AcvmPkUB74DuvG8GEB22w0cLQEBsIAgPhEoDXfYWEzCAy06IboEBkQBAEAQBAEAQBAEAQBAEAQBAEAQGteFlbUY5rhIIIIO4KA5teFF9keQZLNncujv56eCAheLLb2lOnnMYo5Z4f5KDfLox8fsyfYPpSXd9yL4Irlj6xHJo9S7+S3tev5fc0u+r5kjb75YCRiDndDIHif218NVLIZXqr3V3wJOfr1QHV+Brm7NoJCAvACA+oAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAICKvi6m1WkEIDkvGPDpsw7QCAXQeWYJ/ZRLxZgvEmWTxUfgyjFjjMEwdRJg5nUbra2XRZrdPpImbo4fqVYgGFJIp0bhjg8MguCA6FZLOGCAgM6AIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgK5x1cbrXZHU6WEVAWubiyBwnMTtkT/Wa5VqfPDlR1oVFTmpM5MeHalnaGVYxlxJDTiAGQAnfSfNKUHCOGK1RTllHS+DbuaKYJC6nIt7KYGiA9IAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAID44ICt3rcQqOmEBLXVY+zbCA30AQBAEAQBAEAQBAEAQBAEAQBAEAQBAEAQBAEAQBAEAQBAeXID6EB9QBAEAQBAEAQBAEAQBAEAQH//Z" style="display: unset;" alt="">
        </div>
        <div class="card-desc">
          <h4 class="card-title">Sistema em Manutenção</h4>
          <p class="desc">Breve o sistema do depósito GPCIU</p>
          <div class="contact-info active">
            <span class="contact-details">61991169226</span>
            <span class="contact-details">hjdf1988@gmail.com</span>
            <span class="contact-details address-details">
                            <span class="cm-line-break"></span>
                            </span>
          </div>
          <?php
            if(false) {
          ?>
            <button id="contact_us" type="button" class="button-contact" style="border: 0px; padding: 0px;">Contate-nos</button>
          <?php
          }
          ?>
          <ul class="social-media ">
                <li style='display:none;'>
                  <a target="_blank" href="//{ws_url_facebook}">
                    <span class="cm-icon active text-center" style="background: #3460a1;"><i class="fa fa-facebook" aria-hidden="true"></i></span>
                  </a>
                </li>
                <li style='display:none;'>
                  <a target="_blank" href="//{ws_url_instagram}">
                    <span class="cm-icon active text-center" style="background: #3d739c;"><i class="fa fa-instagram" aria-hidden="true"></i></span>
                  </a>
                </li >
                <li style='display:none;'>
                  <a target="_blank" href="//{ws_url_twitter}">
                    <span class="cm-icon active text-center" style="background: #3d739c;"><i class="fa fa-twitter" aria-hidden="true"></i></span>
                  </a>
                </li>
                <li style='display:none;'>
                  <a target="_blank" href="//{ws_url_youtube}">
                    <span class="cm-icon active text-center" style="background: #cd201f;"><i class="fa fa-youtube" aria-hidden="true"></i></span>
                  </a>
                </li>
          </ul>
        </div>
      </div>
    </div>

    <div id="contact_form" class="mod-card"  style="display: none;">
      <form name="contactform" method="post" action="paginafacil.php">
        <div class="card-desc">
          <div class="row">
            <div class="col-md-10">
              <h4 id="webpresence-template-title" class="card-title">Deixe uma mensagem</h4>
            </div>
            <div class="col-md-2">
              <button id="form_close" type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome">
                <label id="name-error" class="control-label" for="name" style="display: none;">O nome é obrigatório</label>
              </div>
              <div class="form-group">
                <label for="phone">Telefone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone">
              </div>
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                <label id="email-error" class="control-label" for="email" style="display: none;">O e-mail é obrigatório</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="message">Mensagem</label>
                <textarea name="message" id="message" class="form-control" rows="6"></textarea>
                <label id="message-error" class="control-label" for="message" style="display: none;">A mensagem é obrigatória</label>
              </div>
              <!--
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input id="not_robot" type="checkbox"> Não sou um robô
                  </label>
                </div>
              </div>
              -->
              <div class="form-group">
                <button id="contact_send_button" type="submit" class="btn btn-primary" style="width:100%;">Enviar</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!--
    <div class="powered-by">
      <a class="powered-by-anchor" href="#" target="_blank"></a>
    </div>
  -->
  </div>
</main>
<script type="text/javascript">
   window.onload = function() {
       var windowW = window.innerWidth;
       var windowH = window.innerHeight;

       var cardH = document.getElementsByClassName('mod-card')[0].offsetHeight;
       var cardHalf = (windowH - cardH) / 2 - 30;

       if (windowW < 768) {

           if (windowH > cardH) {
               console.log("yes");
               document.getElementsByClassName('mod-card')[0].setAttribute("style", "margin-top:" + cardHalf + "px;");
           } else {
               console.log("no");
               document.getElementsByClassName('mod-card')[0].setAttribute("style", "");
           }

       }

   }
 </script>
 <script>
   $( document ).ready(function() {
        $("#contact_us").click(function() {
         $("#contact_form").slideDown(500);
         $("#site_main_content").hide();
        });

        $("#form_close").click(function() {
         $("#site_main_content").show();
         $("#contact_form").slideUp(500);
        });

        // Form validation
        $("#contact_send_button").click(function(event) {
            if ($("#name").val().length == 0) {
                $("#name").parent().addClass("has-error");
                $("#name-error").show();
                event.preventDefault();
            } else if ($("#email").val().length == 0) {
                $("#email").parent().addClass("has-error");
                $("#email-error").show();
                event.preventDefault();
            } else if ($("#message").val().length == 0) {
                $("#message").parent().addClass("has-error");
                $("#message-error").show();
                event.preventDefault();
            } else {
                   var $btn = $(this);
                   $btn.addClass("disabled");
                   $btn.html("<i class='fa fa-circle-o-notch fa-spin'></i>");
               }
        });

       $( "#name" ).on('change keyup paste', function() {
           if ($("#name").val().length > 0) {
               $("#name-error").hide();
               $("#name").parent().removeClass("has-error");
           }
       });

       $( "#email" ).on('change keyup paste', function() {
           if ($("#email").val().length > 0) {
               $("#email-error").hide();
               $("#email").parent().removeClass("has-error");
           }
       });

       $( "#message" ).on('change keyup paste', function() {
           if ($("#message").val().length > 0) {
               $("#message-error").hide();
               $("#message").parent().removeClass("has-error");
           }
       });

   });
 </script>


<!-- RD Station from https://github.com/ResultadosDigitais/rdocs/blob/master/integration_php.md-->
<?php

class RD_Station{
  public $form_data;
  public $token;
  public $identifier;
  public $ignore_fields = array();
  public $redirect_success = null;
  public $redirect_error = null;

  private $api_url = "https://www.rdstation.com.br/api/1.3/conversions";

  public function __construct($form_data){
    $this->form_data = $form_data;
  }

  public function ignore_fields(array $fields){
    foreach ($this->form_data as $field => $value) {
      if(in_array($field, $fields)){
        unset($this->form_data[$field]);
      }
    }
  }

  public function canSaveLead($data){
    $required_fields = array('email', 'token_rdstation');
    foreach ($required_fields as $field) {
      if(empty($data[$field]) || is_null($data[$field])){
        return false;
      }
    }
    return true;
  }

  function createLead() {
    $data_array = $this->form_data;
    $data_array['token_rdstation'] = $this->token;
    $data_array['identificador'] = $this->identifier;

    if(empty($data_array["c_utmz"])){
      $data_array["c_utmz"] = $_COOKIE["__utmz"];
    }

    if ( isset($_COOKIE["__trf_src"]) && empty($data_array["traffic_source"]) ) {
      $data_array["traffic_source"] = $_COOKIE["__trf_src"];
    }

    if(empty($data_array["client_id"]) && !empty($_COOKIE["rdtrk"])) {
      $data_array["client_id"] = json_decode($_COOKIE["rdtrk"])->{'id'};
    }

    $data_query = http_build_query($data_array);

    if($this->canSaveLead($data_array)){
      if (in_array ('curl', get_loaded_extensions())) {
        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_query);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);
        curl_close($ch);
      }
      else {
        $params = array( 'http' => array( 'method' => 'POST', 'content' => $data_query ) );
        $ctx = stream_context_create($params);
        $fp = @fopen($api_url, 'rb', false, $ctx);
      }
      $this->redirect_success ? header("Location: ".$this->redirect_success) : header("Location: /");
    }
    else{
      $this->redirect_error ? header("Location: ".$this->redirect_error) : header("Location: /");
    }
  }
}

?>
<!-- RD Station -->
 <!-- email -->

 <?php
try {
  if(isset($_POST['email'])) {


      $email_to = "";
      $email_subject = "Contato realizado pelo página fácil Sistema em Manutenção";

      $name = $_POST['name']; // required
      $email_from = $_POST['email']; // required
      $phone = $_POST['phone']; // not required
      $message = $_POST['message']; // required

      $error_message = "";
      $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_from)) {
      $error_message .= '<br />Email inválido.';
    }


    if($name == '') {
      $error_message .= '<br />Por favor informe o nome.';
    }

    if(strlen($message) < 4) {
      $error_message .= '<br />Mensagem muito curta.';
    }


    if(strlen($error_message) <= 0) {
      $email_message = "Um novo contato foi realizado através do página fácil Sistema em Manutenção:\n\n";


      function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
      }



      $email_message .= "Nome: ".clean_string($name)."\n";
      $email_message .= "Email: ".clean_string($email_from)."\n";
      if ($phone) {
          $email_message .= "Telefone: ".clean_string($phone)."\n";
      }

      $email_message .= "Mensagem: ".clean_string($message)."\n";

      // create email headers
      $headers = 'From: '.$email_from."\r\n".
      'Reply-To: '.$email_from."\r\n" .
      'X-Mailer: PHP/' . phpversion();
      //@mail($email_to, $email_subject, $email_message, $headers);
      @mail($email_to, $email_subject, $email_message, $headers);

      $return_message = "Obrigado pelo contato!";
    } else {
        $return_message = $error_message;
    }

    // RD Station
    if (false) {

      // Instanciando a classe RD_Station
      $rdstation = new RD_Station($_POST);

      // Token público do RD Station
      $rdstation->token = '{ws_contact_form_token}';

      // Identificador do formulário
      $rdstation->identifier = '{ws_contact_form_id}';

      // Ignorando campos desnecessários
      $rdstation->ignore_fields(array('message'));

      // Redirecionamento caso tudo esteja ok
      $rdstation->redirect_success = '';

      // Redirecionamento caso ocorram erros
      $rdstation->redirect_error = '';

      // Criando os leads
      $rdstation->createLead();
  }

  ?>

  <!-- include your own success html here -->
  <script>
    vex.dialog.alert("<?php echo $return_message; ?>");
  </script>

  <?php

  }
}catch (Exception $e) {
  error_log("EXCEPTION in sending email in pre-site 'Sistema em Manutenção': ". $e->getMessage());
}
?>

</body></html>
