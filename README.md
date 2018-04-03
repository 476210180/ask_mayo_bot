# 简介
诶……摸鱼写了一个类似 askfm 的提问/留言板（像是有公共栏的 Sarahah），不过是 Telegram 小 Bot 的形式，可以选择公开或私密 🍓

乃们有想对我说的话/提问吗：
http://t.me/ask_mayo_bot

# 部署一个

运行在 Heroku 上非常方便，免费实例就够用了，还提供 Https（也是 Telegram Bot Webhook 必要的）。

## 创建 Bot

在 Telegram 上找 @botfather 创建一个，修改好 ID、昵称、头像、BIO 等，再复制好 API Token。

## 创建频道

用于 Bot 自动发送公共留言。
需要在频道->成员->管理员，输入 Bot 的 ID，查找后添加成管理员，才有发文权限。

## 部署代码

注册一个 [Heroku](https://heroku.com) 账号，下载好 Heroku CLI，在面板创建一个应用，选择 PHP（好像也没选项？）。

$ git clone https://github.com/mayocream/ask_mayo_bot
$ cd ask_mayo_bot
$ heroku login
$ heroku git:clone -a <Heroku 应用 ID>
$ git add .
$ git commit -am init
$ git push heroku master

## 添加变量

代码里有几个设置需要填写。
以环境变量来读取。

在 Heroku 的 App 页面，点进去选择 Settings，配置 Config Variables。

BOT_API_TOKEN 填写 Telegram Bot Api Token
MASTER_NAME 填写 你的昵称，替换“真夜”
MASTER_USER_ID 在 Telegram @ask_mayo_bot 对话窗输入 /user_id，把返回的数字填进去
CHANNAL_ID 频道 ID，格式是 @ask_mayo，注意带 at 符号

保存。

## 设置 Webhook

直接用浏览器访问
https://api.telegram.org/bot<API_Token>/setWebhook?url=https://<Heroku 应用域名>/web.php

把 <API_Token> 替换成 API Token
<Heroku 应用域名> 替换成 Heroku 的应用域名，在应用 Settings 里面有网址。

访问后会返回 Json 提示已设置。

---
好像就差不多了？你先试试 qwq