-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 01 2024 г., 12:09
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `MibitMar`
--

-- --------------------------------------------------------

--
-- Структура таблицы `alboms`
--

CREATE TABLE `alboms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `alboms`
--

INSERT INTO `alboms` (`id`, `title`, `img`, `user_id`, `date`, `created_at`, `updated_at`) VALUES
(1, '÷', '/storage/public/img/qPtS5WYNZrtHmG5u79dJVkVIvNATRihPTJaiARsf.jpg', 5, '2017-12-30', '2024-03-08 13:26:02', '2024-03-08 13:26:02');

-- --------------------------------------------------------

--
-- Структура таблицы `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `track_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `applications`
--

INSERT INTO `applications` (`id`, `category_id`, `user_id`, `track_id`, `status`, `title`, `text`, `created_at`, `updated_at`) VALUES
(2, 1, 4, NULL, 'одобрена', 'Taylor Swift', 'Хочу стать исполнителем\r\nЛейбл: Big Machine Records', '2024-03-06 04:22:54', '2024-03-06 05:07:52'),
(3, 1, 5, NULL, 'одобрена', 'Kendrick Lamar', 'Звукозаписывающие компании: pgLang,\r\nПартнер: Уитни Алфорд (2015 г.–)', '2024-03-07 12:31:38', '2024-03-07 12:36:48'),
(4, 1, 6, NULL, 'одобрена', 'Jungkook', 'Хочу стать исполнителем\r\nКомпания: BigHit', '2024-03-07 14:49:08', '2024-03-07 14:53:12'),
(5, 2, 4, 1, 'новый', 'Ограничение права', 'Хочу ограничить права к треку всвязи...', '2024-03-11 17:32:47', '2024-03-11 17:32:47');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'стать исполнителем', '2024-03-06 06:24:54', '2024-03-06 06:24:54'),
(2, 'ограничение права', '2024-03-11 11:28:39', '2024-03-11 11:28:39'),
(3, 'удаление трека', '2024-03-11 11:29:05', '2024-03-11 11:29:05');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `title`, `created_at`, `updated_at`, `img`) VALUES
(1, 'Хип-хоп', '2024-03-06 02:09:52', '2024-03-06 06:19:27', '/storage/public/img/xEQHm0Vp7w7Eo8grtKXmhGgdybwpHCpWD6OSW5EU.png'),
(2, 'Рок', '2024-03-06 02:10:00', '2024-03-06 06:19:45', '/storage/public/img/Hu62Ap5t9vcpmYGioRjas2RkGpDmj37clkROWmae.png'),
(3, 'Классическая музыка', '2024-03-06 02:10:12', '2024-03-06 02:10:12', ''),
(4, 'Электронная музыка', '2024-03-06 02:10:20', '2024-03-06 06:19:54', '/storage/public/img/i9dJuJ6wYo3Vh1RdJZhTmUyEaD0ZMLaI3MgexQZN.png'),
(5, 'Шансон', '2024-03-06 02:10:30', '2024-03-06 06:20:02', '/storage/public/img/HREzYLN2mu8WtKVVl1luc0jprwICjhs829Vvq9q5.png'),
(6, 'R&B', '2024-03-06 02:10:37', '2024-03-06 06:20:17', '/storage/public/img/2lvDnS4LX6I4rLWYn9vSGs5bEbOU927Igyz5gTle.png'),
(7, 'Джаз', '2024-03-06 02:11:21', '2024-03-06 02:11:21', ''),
(8, 'Рэп', '2024-03-06 02:11:25', '2024-03-06 02:11:25', ''),
(9, 'Поп', '2024-03-06 02:11:33', '2024-03-06 06:20:11', '/storage/public/img/g94A1SaSiQQFR2z2bC48hEAVqNEEpcyhqfOc2Hx7.png');

-- --------------------------------------------------------

--
-- Структура таблицы `genre_alboms`
--

CREATE TABLE `genre_alboms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `genre_id` bigint(20) UNSIGNED NOT NULL,
  `albom_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `genre_alboms`
--

INSERT INTO `genre_alboms` (`id`, `genre_id`, `albom_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-03-08 13:26:02', '2024-03-08 13:26:02');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_10_091331_create_genres_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_095222_create_user_genres_table', 1),
(4, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2024_02_28_091301_create_categories_table', 1),
(8, '2024_02_28_091349_create_alboms_table', 1),
(9, '2024_02_28_091431_create_tracks_table', 1),
(11, '2024_02_28_091516_create_person_tracks_table', 1),
(12, '2024_02_28_091536_create_track_alboms_table', 1),
(13, '2024_02_28_091741_create_playlists_table', 1),
(15, '2024_02_28_091817_create_user_alboms_table', 1),
(19, '2024_02_28_091453_create_applications_table', 2),
(20, '2024_02_28_095221_create_genre_alboms_table', 3),
(21, '2024_02_28_101852_create_user_playlists_table', 4),
(22, '2024_02_28_091804_create_track_playlists_table', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `person_tracks`
--

CREATE TABLE `person_tracks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `track_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `person_tracks`
--

INSERT INTO `person_tracks` (`id`, `user_id`, `track_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, '2024-03-08 11:42:13', '2024-03-08 11:42:13'),
(3, 5, 2, '2024-03-08 11:42:13', '2024-03-08 11:42:13'),
(4, 5, 3, '2024-03-08 13:18:29', '2024-03-08 13:18:29'),
(5, 5, 4, '2024-03-08 13:22:10', '2024-03-08 13:22:10'),
(6, 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `playlists`
--

CREATE TABLE `playlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `playlists`
--

INSERT INTO `playlists` (`id`, `title`, `text`, `img`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Мои биты', 'Здесь собраны любимые композиции', '', 7, NULL, NULL),
(2, 'Winter 2024', 'Треки, которые слушаю зимой 2024', '/storage/public/img/xaGn8AFfWydK4InXPWWDEOT8JqBessQEwF4HkXmK.jpg', 7, '2024-03-09 10:18:59', '2024-03-09 10:18:59'),
(3, 'Мои биты', '', '', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tracks`
--

CREATE TABLE `tracks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre_id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `song` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count_listen` int(11) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Новый',
  `date` date NOT NULL,
  `cenz` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tracks`
--

INSERT INTO `tracks` (`id`, `title`, `text`, `genre_id`, `img`, `song`, `count_listen`, `status`, `date`, `cenz`, `created_at`, `updated_at`) VALUES
(1, 'Lover', 'We could leave the Christmas lights up \'til January\nAnd this is our place, we make the rules\nAnd there\'s a dazzling haze, a mysterious way about you dear\nHave I known you 20 seconds or 20 years?\nCan I go where you go?\nCan we always be this close forever and ever?\nAnd ah, take me out, and take me home\nYou\'re my, my, my, my\nLover\nWe could let our friends crash in the living room\nThis is our place, we make the call\nAnd I\'m highly suspicious that everyone who sees you wants you\nI\'ve loved you three summers now, honey, but I want \'em all\nCan I go where you go?\nCan we always be this close forever and ever?\nAnd ah, take me out, and take me home (forever and ever)\nYou\'re my, my, my, my\nLover\nLadies and gentlemen, will you please stand?\nWith every guitar string scar on my hand\nI take this magnetic force of a man to be my lover\nMy heart\'s been borrowed and yours has been blue\nAll\'s well that ends well to end up with you\nSwear to be overdramatic and true to my lover\nAnd you\'ll save all your dirtiest jokes for me\nAnd at every table, I\'ll save you a seat, lover\nCan I go where you go?\nCan we always be this close forever and ever?\nAnd ah, take me out, and take me home (forever and ever)\nYou\'re my, my, my, my\nOh, you\'re my, my, my, my\nDarling, you\'re my, my, my, my\nLover', 4, '/storage/public/img/szYEvHPVcFWoykt5Oh8n7SkZNPVfthH1z5RkvGqS.png', '/storage/public/music/heufwZE8563ylIrx2FuGOzlh0f3oR1PLr3sHw7e0.mp4', 0, 'В доступе', '2024-03-13', 1, '2024-03-06 10:41:24', '2024-03-06 10:41:24'),
(2, 'Fifteen', 'You take a deep breath\r\nAnd you walk through the doors\r\nIt\'s the morning of your very first day\r\nYou say hi to your friends you ain\'t seen in awhile\r\nTry and stay out of everybody\'s way\r\nIt\'s your freshman year\r\nAnd you\'re gonna be here for the next four years\r\nIn this town\r\nHoping one of those senior boys\r\nWill wink at you and say\r\n\"You know I haven\'t seen you around, before\"\r\n\'Cause when you\'re fifteen\r\nAnd somebody tells you they love you\r\nYou\'re gonna believe them\r\nAnd when you\'re fifteen\r\nFeeling like there\'s nothing to figure out\r\nWell, count to ten\r\nTake it in\r\nThis is life before you know who you\'re gonna be\r\nAt fifteen\r\nYou sit in class next to a red-head named Abigail\r\nAnd soon enough you\'re best friends\r\nLaughing at the other girls\r\nWho think they\'re so cool\r\nWe\'ll be out of here as soon as we can\r\nAnd then you\'re on your very first date\r\nAnd he\'s got a car\r\nAnd you\'re feeling like flying\r\nAnd your mama\'s waiting up\r\nAnd you\'re thinking he\'s the one\r\nAnd you\'re dancing \'round your room when the night ends\r\nWhen the night ends\r\n\'Cause when you\'re fifteen\r\nAnd somebody tells you they love you\r\nYou\'re gonna believe them\r\nAnd when you\'re fifteen\r\nAnd your first kiss makes your head spin around\r\nWell, in your life you\'ll do things\r\nGreater than dating the boy on the football team\r\nI didn\'t know it at fifteen\r\nWhen all you wanted\r\nWas to be wanted\r\nWish you could go back\r\nAnd tell yourself what you know now\r\nBack then I swore I was gonna marry him someday\r\nBut I realized some bigger dreams of mine\r\nAnd Abigail gave everything she had\r\nTo a boy who changed his mind\r\nAnd we both cried\r\n\'Cause when you\'re fifteen\r\nAnd somebody tells you they love you\r\nYou\'re gonna believe them\r\nAnd when you\'re fifteen\r\nDon\'t forget to look before you fall\r\nBut I\'ve found time can heal most anything\r\nAnd you just might find who you\'re supposed to be\r\nI didn\'t know who I was supposed to be\r\nAt fifteen\r\nLa-la la-la la-la-la-la\r\nLa-la la-la la-la-la-la\r\nLa-la la-la\r\nYour very first day\r\nTake a deep breath girl\r\nTake a deep breath as you walk through the doors', 4, '/storage/public/img/t0FaI8XWNnbAgyxYC1yuYBMOXbQvqKItlsqEM0gr.jpg', '/storage/public/music/Mk0BIs56djoXmks72E30Ae9JNaWgrG9o0WooXgBY.mp3', 0, 'В доступе', '2024-05-12', 0, '2024-03-08 11:42:13', '2024-03-08 11:42:13'),
(3, 'Eraser', 'I was born inside a small town, I lost that state of mind\r\nLearned to sing inside the Lord\'s house, but stopped at the age of nine\r\nI forget when I get awards now the wave I had to ride\r\nThe paving stones I played upon, they kept me on the grind\r\nSo blame it on the pain that blessed me with the life\r\nFriends and family filled with envy when they should be filled with pride\r\nAnd when the world\'s against me is when I really come alive\r\nAnd everyday that Satan tempts me, I try to take it in my stride\r\nYou know that I\'ve got whisky with white lies and smoke in my lungs\r\nI think life has got to the point I know without it\'s no fun\r\nI need to get in the right mind and clear myself up\r\nInstead, I look in the mirror questioning what I\'ve become\r\nI guess it\'s a stereotypical day for someone like me\r\nWithout a nine-to-five job or an uni degree\r\nTo be caught up in the trappings of the industry\r\nShow me the locked doors, I find another use for the key\r\nAnd you\'ll see\r\nI\'m well aware of certain things that can destroy a man like me\r\nBut with that said give me one more, higher\r\nAnother one to take the sting away\r\nI am happy on my own, so here I\'ll stay\r\nSave your lovin\' arms for a rainy day\r\nAnd I\'ll find comfort in my pain, eraser\r\nI used to think that nothing could be better than touring the world with my songs\r\nI chased the pictured perfect life, I think they painted it wrong\r\nI think that money is the root of evil and fame is hell\r\nRelationships and hearts you fixed, they break as well\r\nAnd ain\'t nobody wanna see you down in the dumps\r\nBecause you\'re living your dream, man, this shit should be fun\r\nPlease know that I\'m not trying to preach like I\'m Reverend Run\r\nI beg you, don\'t be disappointed with the man I\'ve become\r\nOur conversations with my father on the A14\r\nAge twelve telling me I\'ve gotta chase those dreams\r\nNow I\'m playing for the people, dad, and they know me\r\nWith my beat and small guitar wearing the same old jeans\r\nWembley Stadium crowd\'s two-hundred-and-forty-thou\'\r\nI may have grown up but I hope that Damien\'s proud\r\nAnd to the next generation, inspiration\'s allowed\r\nThe world may be filled with hate but keep erasing it now\r\nSomehow\r\nI\'m well aware of certain things that will befall a man like me\r\nBut with that said give me one more, higher\r\nAnother one to take the sting away\r\nOh, I am happy on my own, so here I\'ll stay\r\nSave your lovin\' arms for a rainy day\r\nAnd I\'ll find comfort in my pain, eraser\r\nAnd I\'ll find comfort in my pain, eraser\r\nAnd I\'ll find comfort in my pain, eraser\r\nWelcome to the new show\r\nI guess you know I\'ve been away\r\nBut where I\'m heading, who knows\r\nBut my heart will stay the same\r\nWelcome to the new show\r\nI guess you know I\'ve been away\r\nBut where I\'m heading, who knows\r\nMy pain, eraser\r\nAnd I\'ll find comfort in my pain, eraser\r\nAnd I\'ll find comfort in my pain, eraser\r\nAnd I\'ll find comfort in my pain, eraser\r\nAnd I\'ll find comfort in my pain, eraser', 1, '/storage/public/img/YWSmfrGUKnGemhpFE9dnVkdeGRONPQP2WYMR3sxU.jpg', '/storage/public/music/phiuOjnDiXIxfgTbufgTREOdqWwPZUCVAxhXr2Zl.mp3', 1, 'В доступе', '2017-05-03', 0, '2024-03-08 13:18:29', '2024-03-09 07:03:43'),
(4, 'Perfect', 'I found a love, for me\r\nDarling, just dive right in and follow my lead\r\nWell, I found a girl, beautiful and sweet\r\nOh, I never knew you were the someone waiting for me\r\n\'Cause we were just kids when we fell in love\r\nNot knowing what it was\r\nI will not give you up this time\r\nBut darling, just kiss me slow\r\nYour heart is all I own\r\nAnd in your eyes, you\'re holding mine\r\nBaby, I\'m dancing in the dark\r\nWith you between my arms\r\nBarefoot on the grass\r\nListening to our favourite song\r\nWhen you said you looked a mess\r\nI whispered underneath my breath\r\nBut you heard it\r\nDarling, you look perfect tonight\r\nWell, I found a woman, stronger than anyone I know\r\nShe shares my dreams, I hope that someday I\'ll share her home\r\nI found a lover, to carry more than just my secrets\r\nTo carry love, to carry children of our own\r\nWe are still kids, but we\'re so in love\r\nFighting against all odds\r\nI know we\'ll be alright this time\r\nDarling, just hold my hand\r\nBe my girl, I\'ll be your man\r\nI see my future in your eyes\r\nBaby, I\'m dancing in the dark\r\nWith you between my arms\r\nBarefoot on the grass\r\nListening to our favorite song\r\nWhen I saw you in that dress, looking so beautiful\r\nI don\'t deserve this\r\nDarling, you look perfect tonight\r\nBaby, I\'m dancing in the dark\r\nWith you between my arms\r\nBarefoot on the grass\r\nListening to our favorite song\r\nI have faith in what I see\r\nNow I know I have met an angel in person\r\nAnd she looks perfect\r\nI don\'t deserve this\r\nYou look perfect tonight', 9, '/storage/public/img/TZ7JmglDIQY3vp6ZZn9Aqwzks0QEld53rwkX2wiK.jpg', '/storage/public/music/v2KgugRnZ6jEUqQ1SmQPZuDj8Nfa0v0bIpcsdOf3.mp3', 4, 'В доступе', '2017-12-01', 0, '2024-03-08 13:22:10', '2024-08-01 03:02:19');

-- --------------------------------------------------------

--
-- Структура таблицы `track_alboms`
--

CREATE TABLE `track_alboms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `track_id` bigint(20) UNSIGNED NOT NULL,
  `albom_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `track_alboms`
--

INSERT INTO `track_alboms` (`id`, `track_id`, `albom_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2024-03-08 13:26:02', '2024-03-08 13:26:02'),
(2, 4, 1, '2024-03-08 13:26:02', '2024-03-08 13:26:02');

-- --------------------------------------------------------

--
-- Структура таблицы `track_playlists`
--

CREATE TABLE `track_playlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `track_id` bigint(20) UNSIGNED DEFAULT NULL,
  `playlist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `track_playlists`
--

INSERT INTO `track_playlists` (`id`, `track_id`, `playlist_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, '2024-03-09 10:18:59', '2024-03-09 10:18:59'),
(2, 4, 1, '2024-03-09 10:52:23', '2024-03-09 10:52:23'),
(3, 2, 2, '2024-03-11 07:31:17', '2024-03-11 07:31:17'),
(4, 3, 3, '2024-03-11 07:33:53', '2024-03-11 07:33:53');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `phone`, `email`, `gender`, `email_verified_at`, `img`, `birthday`, `role`, `status`, `password`, `remember_token`, `created_at`, `updated_at`, `nickname`) VALUES
(3, NULL, '89040462335', NULL, '2', NULL, '/storage/public/img/jT5a0N4nev93NAn01WZdteqFA3CamBAUn9MrdOai.jpg', NULL, 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', NULL, '2024-03-06 02:05:17', '2024-03-06 04:58:52', NULL),
(4, 'taylor1989', '89040462337', NULL, '2', NULL, '/storage/public/img/6xFHu3nnP61hSUqITnsMmiEZwUMN9yjeYLI3Chid.jpg', '1989-12-13', 0, 'исполнитель', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '2024-03-06 02:22:43', '2024-03-11 07:39:20', 'Taylor Swift'),
(5, 'kendrik1706', '99999999999', NULL, NULL, NULL, '/storage/public/img/xuUxrdKUuvEsx37WkvADLYukh4j23jMKDzYiESa2.jpg', '1991-02-17', 0, 'исполнитель', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '2024-03-07 12:29:10', '2024-03-08 13:11:02', 'Ed Sheeran'),
(6, 'jungkook1997', '89040462331', NULL, NULL, NULL, '/storage/public/img/t328HYfjkfonq7zDaz2KIhGFDalQP2TliIvc0xY5.jpg', '1997-09-01', 0, 'исполнитель', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '2024-03-07 14:31:58', '2024-03-07 14:53:12', 'Jungkook'),
(7, NULL, '89040462332', NULL, '0', NULL, NULL, NULL, 0, NULL, '827ccb0eea8a706c4c34a16891f84e7b', NULL, '2024-03-09 07:44:36', '2024-03-09 07:44:36', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_genres`
--

CREATE TABLE `user_genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `genre_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_genres`
--

INSERT INTO `user_genres` (`id`, `user_id`, `genre_id`, `created_at`, `updated_at`) VALUES
(54, 3, 2, '2024-03-06 04:59:06', '2024-03-06 04:59:06'),
(55, 3, 6, '2024-03-06 04:59:06', '2024-03-06 04:59:06'),
(56, 3, 8, '2024-03-06 04:59:06', '2024-03-06 04:59:06'),
(87, 6, 1, '2024-03-07 14:44:02', '2024-03-07 14:44:02'),
(88, 6, 2, '2024-03-07 14:44:02', '2024-03-07 14:44:02'),
(89, 6, 4, '2024-03-07 14:44:02', '2024-03-07 14:44:02'),
(90, 6, 7, '2024-03-07 14:44:02', '2024-03-07 14:44:02'),
(91, 5, 2, '2024-03-08 13:11:02', '2024-03-08 13:11:02'),
(92, 5, 4, '2024-03-08 13:11:02', '2024-03-08 13:11:02'),
(93, 5, 8, '2024-03-08 13:11:02', '2024-03-08 13:11:02'),
(94, 5, 9, '2024-03-08 13:11:02', '2024-03-08 13:11:02'),
(95, 7, 1, '2024-03-09 07:44:46', '2024-03-09 07:44:46'),
(96, 7, 3, '2024-03-09 07:44:46', '2024-03-09 07:44:46'),
(97, 7, 4, '2024-03-09 07:44:46', '2024-03-09 07:44:46'),
(98, 7, 6, '2024-03-09 07:44:46', '2024-03-09 07:44:46'),
(99, 7, 9, '2024-03-09 07:44:46', '2024-03-09 07:44:46'),
(100, 4, 1, '2024-03-11 07:39:20', '2024-03-11 07:39:20'),
(101, 4, 2, '2024-03-11 07:39:20', '2024-03-11 07:39:20'),
(102, 4, 6, '2024-03-11 07:39:20', '2024-03-11 07:39:20'),
(103, 4, 7, '2024-03-11 07:39:20', '2024-03-11 07:39:20'),
(104, 4, 9, '2024-03-11 07:39:20', '2024-03-11 07:39:20');

-- --------------------------------------------------------

--
-- Структура таблицы `user_playlists`
--

CREATE TABLE `user_playlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `playlist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `alboms`
--
ALTER TABLE `alboms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alboms_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_category_id_foreign` (`category_id`),
  ADD KEY `applications_user_id_foreign` (`user_id`),
  ADD KEY `applications_track_id_foreign` (`track_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `genre_alboms`
--
ALTER TABLE `genre_alboms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_alboms_genre_id_foreign` (`genre_id`),
  ADD KEY `genre_alboms_albom_id_foreign` (`albom_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `person_tracks`
--
ALTER TABLE `person_tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_tracks_user_id_foreign` (`user_id`),
  ADD KEY `person_tracks_track_id_foreign` (`track_id`);

--
-- Индексы таблицы `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playlists_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `track_alboms`
--
ALTER TABLE `track_alboms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `track_alboms_track_id_foreign` (`track_id`),
  ADD KEY `track_alboms_albom_id_foreign` (`albom_id`);

--
-- Индексы таблицы `track_playlists`
--
ALTER TABLE `track_playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `track_playlists_track_id_foreign` (`track_id`),
  ADD KEY `track_playlists_playlist_id_foreign` (`playlist_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_login_unique` (`login`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `user_genres`
--
ALTER TABLE `user_genres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_genres_user_id_foreign` (`user_id`),
  ADD KEY `user_genres_genre_id_foreign` (`genre_id`);

--
-- Индексы таблицы `user_playlists`
--
ALTER TABLE `user_playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_playlists_user_id_foreign` (`user_id`),
  ADD KEY `user_playlists_playlist_id_foreign` (`playlist_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `alboms`
--
ALTER TABLE `alboms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `genre_alboms`
--
ALTER TABLE `genre_alboms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `person_tracks`
--
ALTER TABLE `person_tracks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `track_alboms`
--
ALTER TABLE `track_alboms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `track_playlists`
--
ALTER TABLE `track_playlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `user_genres`
--
ALTER TABLE `user_genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT для таблицы `user_playlists`
--
ALTER TABLE `user_playlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `alboms`
--
ALTER TABLE `alboms`
  ADD CONSTRAINT `alboms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_track_id_foreign` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `genre_alboms`
--
ALTER TABLE `genre_alboms`
  ADD CONSTRAINT `genre_alboms_albom_id_foreign` FOREIGN KEY (`albom_id`) REFERENCES `alboms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genre_alboms_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `person_tracks`
--
ALTER TABLE `person_tracks`
  ADD CONSTRAINT `person_tracks_track_id_foreign` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `person_tracks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `track_alboms`
--
ALTER TABLE `track_alboms`
  ADD CONSTRAINT `track_alboms_albom_id_foreign` FOREIGN KEY (`albom_id`) REFERENCES `alboms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `track_alboms_track_id_foreign` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `track_playlists`
--
ALTER TABLE `track_playlists`
  ADD CONSTRAINT `track_playlists_playlist_id_foreign` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `track_playlists_track_id_foreign` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_genres`
--
ALTER TABLE `user_genres`
  ADD CONSTRAINT `user_genres_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_genres_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_playlists`
--
ALTER TABLE `user_playlists`
  ADD CONSTRAINT `user_playlists_playlist_id_foreign` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_playlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
