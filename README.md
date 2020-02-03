# 1. Require
- Đối với HDH Linux:
  - disable enforce `setenforce 0`
  - đã cài đặt docker và docker-compose
- Đối với window, macos:
  - cài đặt docker desktop

# 2. Cài đặt
  - Copy file .env-example trong thư mục docker ra .env(Có thể chỉnh sửa các tham số cấu hình như port, tên database, ...)
  - Thực hiện build và start docker: `docker-compose up --build`(đối với Linux OS có thể phải thêm sudo)

# 3. Các thao tác:
  - Truy cập vào đường dẫn(mặc định): `http://localhost:10080` đối với projet và `http://localhost:10081` đối với code coverage
  