<!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <title>登录</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp" />

        <link rel="stylesheet" href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" />
        <link href="/h/css/dlstyle.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            {

            }
        </style>
    </head>

    <body>

        <div class="login-boxtitle">
            <a href="home.html"><img alt="logo" src="/h/images/logobig.png" /></a>
        </div>

        <div class="login-banner">
            <div class="login-main">
                <div class="login-banner-bg"><span></span><img src="/h/images/big.jpg" /></div>
                <div class="login-box">
                    @if(session('assuc'))
                        {{ session('assuc') }}
                    @else
                        {{ session('error') }}
                    @endif
                            <h3 class="title">登录商城</h3>

                            <div class="clear"></div>
                        
                        <div class="login-form">
                          <form action='/login/login' method="post" >
                            {{ csrf_field() }}
                               <div class="user-name">
                                    <label for="user"><i class="am-icon-user"></i></label>
                                    <input type="text" name="uname" id="user" placeholder="邮箱/手机/用户名">
                 </div>
                 
                 <div class="user-pass">
                    <label for="password"><i class="am-icon-lock"></i></label>
                    <input type="password" name="upwd" id="password" placeholder="请输入密码">
                 </div>
                 <div class="user-pass" style="margin-top:20px;">
                     <img src="/code" title="点击切换" onclick="this.src=this.src+'?a='+Math.random()" ><input type="text" name="code" class="required" placeholder="验证码" style="width:130px;margin-left:10px; margin-bottom: 30px;border:1px solid red; ">
                 </div>
                <div class="am-cf" style="margin-top:30px;">
                    <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm">
                </div
              </form>
           </div>
            
            <div class="login-links">
                <label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label>
                <a href="#" class="am-fr">忘记密码</a>
                <a href="/zhuce/add" class="zcnext am-fr am-btn-default">注册</a>
                <br />
            </div>
                
            </div>
            </div>
        </div>
                    <div class="footer ">
                        <div class="footer-hd ">
                            <p>
                                <a href="# ">恒望科技</a>
                                <b>|</b>
                                <a href="# ">商城首页</a>
                                <b>|</b>
                                <a href="# ">支付宝</a>
                                <b>|</b>
                                <a href="# ">物流</a>
                            </p>
                        </div>
                        <div class="footer-bd ">
                            <p>
                                <a href="# ">关于恒望</a>
                                <a href="# ">合作伙伴</a>
                                <a href="# ">联系我们</a>
                                <a href="# ">网站地图</a>
                                <em>© 2015-2025 Hengwang.com 版权所有</em>
                            </p>
                        </div>
                    </div>
    </body>

</html>