## Installation

Install my-project with git

```bash
  git clone https://github.com/Yogabayu/lks-api.git

  composer Install

  composer require laravolt/indonesia

  php artisan vendor:publish --provider="Laravolt\Indonesia\ServiceProvider"

  php artisan migrate

  php artisan laravolt:indonesia:seed

  php artisan serve

```

tambah data di table user

```bash
INSERT INTO `users` (`id`, `name`, `email`, `born-date`, `gender`, `address`, `token`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `province_id`, `district_id`, `id_card_number`) VALUES (NULL, 'Yoga Bayu AP', 'yogabayusbi@gmail.com', '2023-07-11', 'male', 'pnorogo jatim', '', NULL, '25d55ad283aa400af464c76d713c07ad', NULL, NULL, '2023-07-03 03:36:55', '15', '229', '12345678');
```

POstman:

```bash

127.0.0.1:8000/api/v1/auth/login

body:

id_card_number:12345678
password:12345678


127.0.0.1:8000/api/v1/auth/logout

AUTORIZATION->barier-token ->token user didatabase
```
