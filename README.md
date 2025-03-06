# Book Shop - Trang Web Bán Sách

## 1. Giới Thiệu
Book Shop là một trang web bán sách trực tuyến được xây dựng bằng Laravel và Bootstrap. Mục đích của dự án là cung cấp một nền tảng mà người dùng có thể mua sách một cách dễ dàng và thuận tiện.

![image](https://github.com/user-attachments/assets/24c83da7-7b1c-4afb-b190-d171c6dc6a5d)
Sơ đồ tuần tự:
![image](https://github.com/user-attachments/assets/60bbbc97-ac66-4b20-bb5f-4912106f93eb)


## 2. Tính Năng
### 2.1. Dành cho khách hàng
- Xem danh sách sản phảm
- Xem chi tiết sách (tên, tác giả, giá, hình ảnh).
- Thêm sách vào giỏ hàng.
- Cập nhật / xóa sách trong giỏ hàng.
- Thanh toán đơn hàng.

### 2.2. Dành cho Quản Trị Viên
- Quản lý sách:
 + Thêm sách vào trang chủ
 + Chỉnh sửa thông tin sách
 + Xóa sách khỏi trang chủ
- Quản lý danh mục sách.

## 3. Cài Đặt & Chạy Dự Án
### 3.1. Clone Repository
```bash
git clone https://github.com/xtruong0702/bookshop.git
cd bookshop
```

### 3.2. Cài Đặt Package
```bash
composer install
npm install
```

### 3.3. Cấu Hình Môi Trường
- Sao chép file `.env.example` thành `.env`.
- Thiết lập cấu hình database trong file `.env`.

### 3.4. Tạo Database
```bash
php artisan migrate --seed
```

### 3.5. Chạy Dự Án
```bash
php artisan serve
```

## 4. Công Nghệ Sử Dụng
- **Backend:** Laravel 10 (PHP)
- **Frontend:** Bootstrap 5, Blade Template
- **Database:** MySQL
- **Hỗ Trợ:** Vite, Laravel UI

## 5. Hướng Dẫn Sử Dụng
- **Người dùng mới:** Đăng ký tài khoản và bắt đầu mua sách.
- **Quản trị viên:** Quản lý sách và đơn hàng.
    + Tài khoản quản trị viên: admin@example.com
    + Mật khẩu: 12345678

## 6. Tính Năng Dự Kiến Nâng Cấp
- **Thanh toán online**: Tích hợp VNPay, PayPal.
- **Tìm kiếm nâng cao**: Tìm kiếm theo tác giả, danh mục.
- **Hệ thống review**: Cho phép người dùng đánh giá sách.

## 7. Liên Hệ
- **GitHub:** [xtruong0702](https://github.com/xtruong0702)

