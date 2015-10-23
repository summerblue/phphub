<div style="text-align: center; margin-top: 20px">
  <p style="margin-bottom: 10px">客户端登陆二维码</p>
  <img style="height: 180px; width=180px;" " src="data:image/png;base64,{{ base64_encode($user->present()->loginQR(180)) }}">
</div>