<p align="center">
  <h1 align="center">🤖 Telgeram</h1>
  <p align="center">
    A fun and easy Laravel package for building Telegram bots without the hassle.<br>
    Fluent API, conversations, keyboards — all made simple!
  </p>
</p>

<p align="center">
  <a href="https://packagist.org/packages/mahdiimax/telgeram">
    <img src="https://img.shields.io/packagist/v/mahdiimax/telgeram.svg?style=for-the-badge" alt="Packagist Version">
  </a>
  <a href="https://packagist.org/packages/mahdiimax/telgeram">
    <img src="https://img.shields.io/packagist/dt/mahdiimax/telgeram.svg?style=for-the-badge" alt="Total Downloads">
  </a>
  <a href="https://github.com/MahdiiMax/telgeram/blob/main/LICENSE">
    <img src="https://img.shields.io/github/license/MahdiiMax/telgeram.svg?style=for-the-badge" alt="License">
  </a>
  <a href="https://github.com/MahdiiMax/telgeram">
    <img src="https://img.shields.io/github/stars/MahdiiMax/telgeram.svg?style=for-the-badge" alt="GitHub Stars">
  </a>
  <a href="https://www.php.net">
    <img src="https://img.shields.io/badge/PHP-8.3+-blue?style=for-the-badge" alt="PHP Version">
  </a>
  <a href="https://laravel.com">
    <img src="https://img.shields.io/badge/Laravel-13-e74430?style=for-the-badge" alt="Laravel Support">
  </a>
  <a href="#">
    <img src="https://img.shields.io/badge/Status-In%20Development-orange?style=for-the-badge" alt="Status: In Development">
  </a>
</p>

> 🚧 **Telgeram is in active development.** This project is being built phase-by-phase, both as a learning journey and a real package. Head over to the [Roadmap](#roadmap) to see exactly where things stand.

---

## 🎯 What is Telgeram?

**Telgeram** is a Laravel package built to make creating Telegram bots fun and effortless. It aims to provide:

- A **fluent, readable API** so you can ship bots quickly
- First-class support for **commands, keyboards, callbacks** and **conversations**
- Both **webhook and polling** drivers
- **Database persistence** for conversation state

> This is a personal project — built publicly, phase-by-phase, to learn package development inside out and to land a fun, resume-worthy package on Packagist.

---

## 🗺️ Roadmap

Telgeram is developed in 13 phases. Each phase is a small, reviewable step that ends with a commit.

| Status | Phase | Description |
| :---: | :---: | --- |
| ✅ | 0 | **Repo foundation** — README, LICENSE, composer.json, git setup |
| ✅ | 1 | **Package Foundation** — ServiceProvider, Config, Facade, base classes |
| ✅ | 2 | **API Client** — TelegramApi HTTP client |
| ✅ | 3 | **Messaging System** — MessageBuilder, Keyboard, Button |
| ✅ | 4 | **Command System** — CommandRegistry, dispatch |
| ✅ | 5 | **Update Handler** — process updates, callbacks |
| 🚧 | 6 | **Webhook System** — WebhookController, middleware |
| ⬜ | 7 | **Polling System** — PollCommand for local testing |
| ⬜ | 8 | **Conversations** — multi-step flows with state |
| ⬜ | 9 | **Database & Models** — migrations, Eloquent |
| ⬜ | 10 | **Artisan Commands** — CLI tools |
| ⬜ | 11 | **Events** — dispatch events |
| ⬜ | 12 | **Testing & Docs** — Pest tests, documentation |
| ⬜ | 13 | **Polish & Release** — Packagist submission |

**Legend:** ✅ done · 🚧 in progress · ⬜ planned

---

## ✨ Planned Features

These capabilities are part of the vision and will land as the phases above are completed:

- 🧩 **Command Handling** — `/start`, `/help`, and custom commands
- ⌨️ **Inline & Reply Keyboards** — fluent buttons
- 🖱️ **Callback Query Handling** — respond to button presses
- 📦 **Message Types** — text, photos, documents, locations
- 💬 **Multi-step Conversations** — guided flows with per-user state
- 🗄️ **Database Storage** — persistent conversation state
- 🌐 **Webhook & Polling** — both drivers supported

---

## 📋 Requirements *(planned)*

- **PHP** ^8.3
- **Laravel** ^13.0
- **Composer** 2.x

---

## 🚀 Installation *(coming soon)*

The package will be installable via Composer once released:

```bash
composer require mahdiimax/telgeram
```

---

## 🤝 Get Involved

This project is a personal learning journey, and it's built in the open. If you'd like to:

- **Watch the progress** — check back as phases are checked off
- **Learn together** — the roadmap makes it easy to follow along
- **Suggest ideas** — feel free to open an issue

---

## 📄 License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

<p align="center">
  Made with ❤️ by <a href="https://github.com/MahdiiMax">Mahdi Sadeghi</a>
</p>
