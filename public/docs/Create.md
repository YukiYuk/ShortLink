# 创建短链接

## API URL
```
POST /api/create
```

## POST 参数
可以接受标准的 URL-Encoded / JSON / XML 请求
```
target - 目标URL，仅支持 HTTP/HTTPS 或 steam://
```

## 返回值
```
{
    "ok": true,  // 布尔值，表示请求是否成功
    "msg": "",  // 错误信息
    "data": "https://ab.rw/xxxxx"  // 成功时返回短链接，失败时返回null
}
```
