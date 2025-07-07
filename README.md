# 📡 Medos Imitasi API – Dokumentasi Lengkap dengan Contoh

**Base URL:** `http://127.0.0.1:8000/api/v1`

Seluruh endpoint membutuhkan autentikasi JWT **kecuali** `login` dan `register`.
---

## 📁 Posts

### 🔹 get all post
**GET** `http://127.0.0.1:8000/api/v1/posts/`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Ini adalah contoh post.",
  "image_url": "https://example.com/image.jpg"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 get by id
**GET** `http://127.0.0.1:8000/api/v1/posts/1`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Ini adalah contoh post.",
  "image_url": "https://example.com/image.jpg"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 post
**POST** `http://127.0.0.1:8000/api/v1/posts`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Ini adalah contoh post.",
  "image_url": "https://example.com/image.jpg"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 edit post
**PUT** `http://127.0.0.1:8000/api/v1/posts/3`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Ini adalah contoh post.",
  "image_url": "https://example.com/image.jpg"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 delete post
**DELETE** `http://127.0.0.1:8000/api/v1/posts/11`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Ini adalah contoh post.",
  "image_url": "https://example.com/image.jpg"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 New Request
**GET** ``

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Ini adalah contoh post.",
  "image_url": "https://example.com/image.jpg"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 New Request
**POST** `http://127.0.0.1:8000/api/v1/posts`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Ini adalah contoh post.",
  "image_url": "https://example.com/image.jpg"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

## 📁 comments

### 🔹 get comment by post id
**GET** `http://127.0.0.1:8000/api/v1/comments/posts/1`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Komentar yang bagus!"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 post comment by post_id
**POST** `http://127.0.0.1:8000/api/v1/comments/posts/1`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Komentar yang bagus!"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 delete comment
**DELETE** `http://127.0.0.1:8000/api/v1/comments/21`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Komentar yang bagus!"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 edit comment
**PUT** `http://127.0.0.1:8000/api/v1/comments/32`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Komentar yang bagus!"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

## 📁 likes

### 🔹 get likes
**GET** `http://127.0.0.1:8000/api/v1/posts/1/likes`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Ini adalah contoh post.",
  "image_url": "https://example.com/image.jpg"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 post like
**POST** `http://127.0.0.1:8000/api/v1/posts/18/likes?user_id=272`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Ini adalah contoh post.",
  "image_url": "https://example.com/image.jpg"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 delete likes
**DELETE** `http://127.0.0.1:8000/api/v1/posts/17/likes?user_id=15`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Ini adalah contoh post.",
  "image_url": "https://example.com/image.jpg"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

## 📁 messages

### 🔹 send messages
**POST** `http://127.0.0.1:8000/api/v1/messages/`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "receiver_id": 2,
  "message_content": "Halo, apa kabar?"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 get messages
**GET** `http://127.0.0.1:8000/api/v1/messages/42`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "receiver_id": 2,
  "message_content": "Halo, apa kabar?"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 delete messages
**DELETE** `http://127.0.0.1:8000/api/v1/messages/42`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "receiver_id": 2,
  "message_content": "Halo, apa kabar?"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 get message by user
**GET** `http://127.0.0.1:8000/api/v1/messages/get-messages/2`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "receiver_id": 2,
  "message_content": "Halo, apa kabar?"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

## 📁 Auth

### 🔹 Register
**POST** `http://127.0.0.1:8000/api/v1/register`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "fullname": "John Doe",
  "email": "john@example.com",
  "password": "secret123"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```

### 🔹 Logiin
**POST** `http://127.0.0.1:8000/api/v1/login`

**Headers:**
```http
Authorization: Bearer {JWT_TOKEN}
Content-Type: application/json
```

**Contoh Request Body:**
```json
{
  "content": "Ini adalah contoh post.",
  "image_url": "https://example.com/image.jpg"
}
```

**Contoh Response Body:**
```json
{
  "success": true,
  "message": "Berhasil diproses",
  "data": {
    "id": 1,
    "content": "Ini adalah contoh konten",
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:05:00.000000Z"
  }
}
```
