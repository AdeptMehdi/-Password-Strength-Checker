# بررسی قدرت رمز عبور

یک اپلیکیشن ساده و کاربردی برای بررسی قدرت رمز عبور که با PHP و Tailwind CSS ساخته شده است.

## ویژگی‌ها

- بررسی قدرت رمز عبور در زمان واقعی
- نمایش بازخورد و راهنمایی برای بهبود رمز عبور
- امکان تولید رمز عبور قوی به صورت خودکار
- رابط کاربری زیبا و ریسپانسیو با Tailwind CSS
- پشتیبانی کامل از زبان فارسی
- معماری MVC برای سازماندهی کد

## پیش‌نیازها

- PHP 7.0 یا بالاتر
- وب سرور Apache با mod_rewrite فعال

## نصب و راه‌اندازی

1. محتویات پروژه را در دایرکتوری وب سرور خود کپی کنید.
2. اطمینان حاصل کنید که mod_rewrite در Apache فعال است.
3. به آدرس `http://localhost/password-checker` در مرورگر خود بروید.

## ساختار پروژه

```
password-checker/
├── app/
│   ├── controllers/      # کنترلرها برای مدیریت درخواست‌ها
│   ├── models/           # مدل‌ها برای منطق کسب و کار
│   └── views/            # نماها برای رابط کاربری
├── public/
│   ├── index.php         # نقطه ورود برنامه
│   ├── js/               # فایل‌های JavaScript
│   └── css/              # استایل‌های اختصاصی (در صورت نیاز)
├── config/
│   └── config.php        # تنظیمات برنامه
└── .htaccess            # تنظیمات ری‌دایرکت Apache
```

## استفاده

1. رمز عبور خود را در فیلد متنی وارد کنید.
2. میزان قدرت رمز عبور و توصیه‌های لازم برای افزایش امنیت به صورت خودکار نمایش داده می‌شود.
3. می‌توانید با کلیک بر روی دکمه "تولید رمز عبور قوی" یک رمز عبور تصادفی و امن دریافت کنید.

## توسعه‌دهنده

- **نام:** مهدی
- **تماس:** @cobramahdi 