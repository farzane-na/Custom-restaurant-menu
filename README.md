# 🍔 Custom Restaurant Menu

A custom WordPress plugin that creates a beautiful and professional **restaurant menu** using **Elementor** and **WooCommerce**.

This plugin allows you to display WooCommerce product categories (e.g., Pizza, Burger, Salad, Appetizers, etc.) inside a single Elementor widget.  
Each category is displayed as a separate section, and a **fixed header navigation** lets users scroll easily between menu sections.  
The active category in the header automatically highlights as you scroll through the menu.

---

## ✨ Features

- Full integration with **Elementor Page Builder**.
- Displays products dynamically from **WooCommerce categories**.
- Fixed header with smooth scroll to category sections.
- Active category highlight while scrolling (using Intersection Observer logic).
- Responsive grid layout with **customizable columns** for desktop, tablet, and mobile.
- Style controls inside Elementor (padding, spacing, grid-template-columns, etc.).
- Multi-language ready (`restaurant-menu` text domain).
- Secure and optimized for WordPress standards.

---

## 📦 Requirements

- WordPress **7.2+**
- PHP **7.4+**
- [Elementor](https://elementor.com/) (free or pro)
- [WooCommerce](https://woocommerce.com/)

---

## 🚀 Installation

1. Download or clone this repository.
2. Upload the folder `custom-restaurant-menu` into your WordPress `wp-content/plugins/` directory.
3. Go to **WordPress Dashboard → Plugins** and activate **Custom Restaurant Menu**.
4. Make sure **WooCommerce** and **Elementor** are active.

---

## 🛠 Usage

1. Open any page with **Elementor Editor**.
2. Search for the widget **“Menu Items”** inside the Elementor panel.
3. Drag & drop the widget onto your page.
4. The widget will automatically:
    - Generate sections for each **WooCommerce product category**.
    - Display products in a responsive grid layout.
    - Add a **fixed header navigation** with category links.

You can customize:
- Number of columns per device (desktop/tablet/mobile).
- Padding and spacing for product items.
- Header offset (top position).
- Typography and colors (via Elementor style controls).

---

## 📂 Project Structure
```bash
│
├── assets/
│ └── css/
│ └── app.css # Custom CSS styles
│
├── widgets/
│ └── menu-items.php # Elementor widget logic
│
├── custom-restaurant-menu.php # Main plugin bootstrap file
└── README.md
```
---

## 🔒 Security Notes

- All output is escaped using WordPress functions (`esc_html`, `esc_attr`, `esc_url`, `wp_kses_post`).
- Dependencies (Elementor + WooCommerce) are checked before the widget is registered.
- The plugin exits gracefully if accessed directly.

---

## 🧑‍💻 Development

- Add new Elementor controls in `menu-items.php` (`_register_controls()`).
- Customize rendering logic in `render()`.
- Enqueue additional styles or scripts using `wp_enqueue_style` and `wp_enqueue_script`.

---

## 👩‍🍳 Author

Developed by **Farzane Nazmabadi**  
🌐 [farzanenazmabadi.ir](https://farzanenazmabadi.ir)  
📌 [GitHub](https://github.com/farzane-na/)

---