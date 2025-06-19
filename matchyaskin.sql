-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 19, 2025 at 10:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matchyaskin`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 5, '2025-06-18 21:39:09', '2025-06-18 21:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `shade` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `suitable_for` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`suitable_for`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `suitable_for`, `created_at`, `updated_at`) VALUES
(1, 'SPF 50+', '[\"Type 1\", \"Type 2\", \"Type 3\", \"Type 4\", \"Type 5\", \"Type 6\"]', NULL, NULL),
(2, 'Vitamin C', '[\"DRNT\", \"DRNW\", \"DRPT\", \"DRPW\", \"ORNT\", \"ORNW\", \"ORPT\", \"ORPW\"]', NULL, NULL),
(3, 'Ceramide', '[\"DRNT\", \"DRNW\", \"DRPT\", \"DRPW\", \"DSNT\", \"DSNW\", \"DSPT\", \"DSPW\"]', NULL, NULL),
(4, 'Hyaluronic Acid', '[\"DRNT\", \"DRNW\", \"DRPT\", \"DRPW\", \"OSNT\", \"OSNW\", \"OSPT\", \"OSPW\"]', NULL, NULL),
(5, 'Aloe Vera', '[\"DRNT\", \"DRNW\", \"DRPT\", \"DRPW\"]', NULL, NULL),
(6, 'Panthenol', '[\"DRNT\", \"DRNW\", \"DRPT\", \"DRPW\", \"DSNT\", \"DSNW\", \"DSPT\", \"DSPW\", \"OSNT\", \"OSNW\", \"OSPT\", \"OSPW\"]', NULL, NULL),
(7, 'SPF 30+', '[\"Type 2\", \"Type 3\", \"Type 4\", \"Type 5\", \"Type 6\"]', NULL, NULL),
(8, 'Niacinamide', '[\"DSNT\", \"DSNW\", \"DSPT\", \"DSPW\", \"OSNT\", \"OSNW\", \"OSPT\", \"OSPW\"]', NULL, NULL),
(12, 'Glycerin', '[\"DRNT\", \"DRNW\", \"DRPT\", \"DRPW\"]', NULL, NULL),
(14, 'SPF 30', '[\"Type 4\", \"Type 5\", \"Type 6\"]', NULL, NULL),
(15, 'Vitamin E', '[\"DRNT\", \"DRNW\", \"DRPT\", \"DRPW\"]', NULL, NULL),
(16, 'Shea Butter', '[\"DSNT\", \"DSNW\", \"DSPT\", \"DSPW\"]', NULL, NULL),
(17, 'Tranexamic Acid', '[\"DRPT\", \"DRPW\", \"DSPT\", \"DSPW\", \"ORPT\", \"ORPW\", \"OSPT\", \"OSPW\"]', NULL, NULL),
(18, 'Coenzyme Q10', '[\"DRNW\", \"DRPW\", \"DSNW\", \"DSPW\", \"ORNW\", \"ORPW\", \"OSNW\", \"OSPW\"]', NULL, NULL),
(19, 'Licorice', '[\"DSNT\", \"DSNW\", \"DSPT\", \"DSPW\", \"OSPT\", \"OSNT\", \"OSPW\", \"OSNW\"]', NULL, NULL),
(20, 'Centella Asiatica', '[\"DSNT\", \"DSNW\", \"DSPT\", \"DSPW\"]', NULL, NULL),
(21, 'Salicylic Acid', '[\"ORNT\", \"ORNW\", \"ORPT\", \"ORPW\", \"OSNT\", \"OSNW\", \"OSPT\", \"OSPW\"]', NULL, NULL),
(22, 'Kaolin Clay', '[\"ORNT\", \"ORNW\", \"ORPT\", \"ORPW\"]', NULL, NULL),
(23, 'Zinc', '[\"ORNT\", \"ORNW\", \"ORPT\", \"ORPW\"]', NULL, NULL),
(24, 'Kojic Acid', '[\"ORNT\", \"ORNW\", \"ORPT\", \"ORPW\"]', NULL, NULL),
(25, 'Retinol', '[\"ORNT\", \"ORNW\", \"ORPT\", \"ORPW\"]', NULL, NULL),
(26, 'Retinaldehyde', '[\"ORNT\", \"ORNW\", \"ORPT\", \"ORPW\"]', NULL, NULL),
(27, 'Retioic Acid', '[\"ORNT\", \"ORNW\", \"ORPT\", \"ORPW\"]', NULL, NULL),
(28, 'Ascorbic Acid', '[\"OSNT\", \"OSNW\", \"OSPT\", \"OSPW\"]', NULL, NULL),
(29, 'Azelaic Acid', '[\"OSNT\", \"OSNW\", \"OSPT\", \"OSPW\"]', NULL, NULL),
(30, 'Licorice Extract', '[\"OSNT\", \"OSNW\", \"OSPT\", \"OSPW\"]', NULL, NULL),
(31, 'Benzoyl Peroxide', '[\"OSNT\", \"OSPT\", \"OSPW\"]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_product`
--

CREATE TABLE `ingredient_product` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_05_24_102537_add_role_to_users_table', 2),
(6, '2025_05_24_104426_create_products_table', 3),
(7, '2025_05_24_104717_create_carts_table', 4),
(8, '2025_05_24_104744_create_transactions_table', 4),
(9, '2025_05_30_000001_update_products_table_add_additional_fields', 5),
(10, '2025_05_30_163538_create_orders_table', 6),
(11, '2025_05_30_163755_create_orders_table', 7),
(12, '2025_05_30_164637_create_skin_tests_table', 8),
(13, '2025_05_30_164650_create_ingredients_table', 8),
(14, '2025_05_30_164703_create_ingredient_product_table', 8),
(15, '2025_05_30_165531_create_skin_tests_table', 9),
(16, '2025_05_31_140738_create_cart_items_table', 10),
(17, '2025_05_31_140738_create_carts_table', 11),
(18, '2025_05_31_163906_create_carts_table', 12),
(19, '2025_05_31_163920_create_cart_items_table', 12),
(20, '2025_05_31_172151_add_skin_type_to_users_table', 13),
(21, '2025_06_01_025917_create_transactions_table', 14),
(22, '2025_06_01_031559_create_transaction_items_table', 15),
(23, '2025_06_01_184355_create_reviews_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `skin_type` enum('dry','oily','normal','combination') NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `category`, `description`, `price`, `image`, `ingredients`, `skin_type`, `seller_id`, `created_at`, `updated_at`, `stock`) VALUES
(20, 'Blemish Control Sunscreen SPF 50+/PA++++', 'Acnes', 'Sunscreen', 'Carasun Solar Smart UV Protector SPF 45 PA++++ Sunscreen. Sunscreen sehari-hari yang membuat kulitmu tampak segar dan cerah hingga 8 jam! Carasun Solar Smart UV Protector adalah sunscreen dengan perlindungan optimal SPF 45 yang menangkal 97.8% UVB, dan PA++++ yang merupakan perlindungan tertinggi terhadap UVA yang dapat memicu hyperpigmentasi dan penuaan dini. Berkat teknologi yang dipatenkan CloudLike™️, tabir surya ini memiliki tekstur unik seringan awan yang non-comedogenic, membuat kulitmu terasa nyaman dan tidak membuat kulit menjadi kusam hingga 8 jam! Diformulasikan Halal dan teruji klinis aman untuk kulit sensitif. Sunblock ini tidak menimbulkan whitecast. Carasun Solar Smart UV Protector diperkaya dengan Niacinamide, Rice Extract, dan CityStem, menutrisi kulit serta melindungi kulit dari radikal bebas dan partikel polusi terkecil yang bisa menyebabkan pori-pori tersumbat.Kulit tetap terlindungi dari bahaya sinar UV dan terjaga kesegarannya.', 55000.00, 'products/Ra4tw9RWhOVeymSKIPTJjdxSMlOOgbY5DoZzZ6MH.png', 'Water, Cyclopentasiloxane, Zinc Oxide, Ethylhexyl Methoxycinnamate, Methyl Methacrylate Crosspolymer, Isononyl Isononanoate, Lauryl PEG-9 Polydimethylsiloxyethyl Dimethicone, Dimethicone, Talc, Polymethylsilsesquioxane, Glycerin, Propylene Glycol, Triethylhexyl Trimellitate, Phenyl Trimethicone, Titanium Dioxide, 4-Terpineol (Tea Tree Oil), Salicylic Acid (BHA), Sodium Hyaluronate (Ha), Panthenol, Niacinamide, Dipotassium Glycyrrhizate, Hydrated Silica, Trimethylsiloxysilicate, Glycol Dimethacrylate Crosspolymer, Butylene Glycol, Diethylamino Hydroxybenzoyl Hexyl Benzoate, Bis-Ethylhexyloxyphenol Methoxyphenyl Triazine, Hydrogen Dimethicone, Polystyrene, Polyvinyl Alcohol, Aluminum Hydroxide, Acrylates/​C10-30 Alkyl Acrylate Crosspolymer, Disodium EDTA, Triethanolamine', 'dry', 2, '2025-06-08 05:00:34', '2025-06-18 21:41:47', 10),
(21, 'Birch Juice Moisturizing Sunscreen SPF 50+ PA++++', 'ROUND LAB', 'Sunscreen', 'Multi-award-winning. Korea’s best selling sunscreen for years.\r\nThis moisturizing sunscreen offers powerful SPF 45+ broad-spectrum protection from harmful UVA and UVB rays—while delivering the comfort of a daily moisturizer.', 285000.00, 'products/bWkYi4Zty8uzQInTbdelwLhGYEdgcs2VqgMzFczR.png', 'Water, Zinc Oxide, Cyclohexasiloxane, Butyloctyl Salicylate, Propanediol, Propylheptyl Caprylate, Isododecane, Caprylyl Methicone, Polyglyceryl-3 Polydimethylsiloxyethyl Dimethicone, Methyl Methacrylate Crosspolymer, Methyl Trimethicone, Betula Platyphylla Japonica Juice, Cryptomeria Japonica Leaf Extract, Nelumbo Nucifera Leaf Extract, Saccharomyces Ferment Filtrate, Glyceryl Glucoside, Sodium Hyaluronate, Hyaluronic Acid, Glycerin, Butylene Glycol, Artemisia Annua, Triethoxycaprylylsilane, Extract, Anthemis Nobilis Flower Oil, Pinus Sylvestris Leaf Oil, Ethylhexylglycerin, Ascorbic Acid, Tocopherol, Glyceryl Caprylate, Caprylyl Glycol, Polymethylsilsesquioxane, Lauryl Polyglyceryl-3 Polydimethylsiloxyethyl Dimethicone, 1,2-Hexanediol, Polyglyceryl-2 Dipolyhydroxystearate, Disteardimonium Hectorite, Magnesium Sulfate', 'dry', 2, '2025-06-08 05:02:30', '2025-06-18 21:41:35', 10),
(22, 'Kiehl’s Heritage Rosewater Toner', 'Kiehl’s', 'Toner', 'A hydrating and balancing Rosewater Toner featuring limited edition Heritage Collection packaging.', 520000.00, 'products/15R0z3W6VsFwgYIoWoBrWMjlTX5YlyBTTg2SJB7i.png', 'Aqua/​Water, Propylene Glycol, Rosa Damascena Flower Water, Propanediol, Glycerin, Phenoxyethanol, Chlorphenesin, Rosa Damascena Flower, Disodium EDTA, Allantoin, Arginine, Citric Acid, Salicylic Acid, Sodium Hydroxide', 'dry', 2, '2025-06-08 05:15:35', '2025-06-18 21:57:21', 7),
(23, 'Birch Juice Moisturizing Toner', 'Round Lab', 'Toner', 'Infused with Birch Extract and Vitamin Hyaluronic Acid, experience deep and long-lasting hydration on another level.', 280000.00, 'products/2HaWHWrJ38aruIPxagQZeg564rEo7StmKqBcmDme.webp', 'Purified Water, Glycerin, Propanediol, Glycereth-26, Pentylene Glycol, Betula Alba Juice (10,000Ppm), 1,2-Hexanediol, Chondrus Crispus Extract, Saccharum Officinarum Extract, Sodium Hyaluronate, Hyaluronic Acid, Panthenol, Tromethamine, Dipotassium Glycyrrhizate, Glyceryl Caprylate, Glyceryl Glucoside, Butylene Glycol, Ascorbic Acid, Carbomer, Xanthan Gum, Disodium EDTA', 'dry', 2, '2025-06-08 05:16:31', '2025-06-18 21:57:10', 3),
(25, 'Birch Juice Moisturizing Cream', 'Round Lab', 'Moisturizer', 'A gentle, well-rounded moisturizer for total moisture care and skin barrier strengthening.', 470000.00, 'products/MIVLfhqFHbJ2Oob9ll6tup9dwjyug7J9y95lJCLQ.png', 'Water, Glycerin, Isononyl Isononanoate, Isododecane, 1,2-Hexanediol, Pentylene Glycol, Polydecene, Betula Platyphylla Japonica Juice, Jojoba Esters, Panthenol, Glyceryl Glucoside, Acacia Senegal Gum, Hydrolyzed Hibiscus Esculentus Extract, Sodium Hyaluronate, Hyaluronic Acid, Lupinus Albus Seed Extract, Moringa Pterygosperma Seed Extract, Melia Azadirachta Leaf Extract, Melia Azadirachta Flower Extract, Coccinia Indica Fruit Extract, Aloe Barbadensis Flower Extract, Solanum Melongena (Eggplant) Fruit Extract, Ocimum Sanctum Leaf Extract, Corallina Officinalis Extract, Curcuma Longa (Turmeric) Root Extract, Ascorbic Acid, Pentaerythrityl Tetraethylhexanoate, Ammonium Acryloyldimethyltaurate/​VP Copolymer, Polyglyceryl-3 Methylglucose Distearate, Acrylates/​C10-30 Alkyl Acrylate Crosspolymer, Tromethamine, Glyceryl Acrylate/​Acrylic Acid Copolymer, Ethylhexylglycerin, Agar, Dipotassium Glycyrrhizate, Glyceryl Caprylate, Butylene Glycol, Disodium EDTA', 'dry', 2, '2025-06-08 06:59:54', '2025-06-18 21:56:55', 5),
(26, 'Niacinamide Brightening Cleanser', 'SKINTIFIC', 'Cleanser', 'SKINTIFIC Niacinamide Brightening Cleanser merupakan cleanser dengan tekstur yang padat namun lembut, dapat membuat busa dengan mudah dan kaya. Diformulasikan dengan Niacinamide, Alpha Arbutin, dan Enzyme, menjadikan kulit tampak lebih cerah dan halus, serta membersihkan secara menyeluruh. Enzyme dari Lactobacillus Ferment Lysate, Bromelain dan Papain, mengembalikan kesegaran dan menjaga kesehatan kulit. Diperkaya dengan 5X Ceramide, menjaga kelembaban kulit dan merawat skin barrier. Diformulasikan untuk mencerahkan kulit, menjadikan kulit tampak lebih bersinar dengan daya bersih yang kuat.', 187500.00, 'products/Njrnl6gsOTmv1OhhqtbGG27YtYcKkKMm5wJSpn7i.webp', 'Aqua, Glycerin, Tranexamic Acid, Sodium Cocoyl Glycinate, Amino Acid, Lauryl Betaine, Hydroxypropyl Starch Phosphate, Citric Acid, Hyaluronic Acid, PEG-60 Glyceryl Isostearate, Sodium Chloride, Glyceryl Stearate SE, Coco-Glucoside, Phenoxyethanol, Sodium Cocoyl Isethionate, Sodium Phytate, Ethylhexylglycerin, Polyquaternium-7, 1,2-Hexanediol, Quillaja Saponaria Bark Extract, Sodium Benzoate, Ceramide NP, Ceramide EOP, Ceramide AP, Centella Asiatica Extract, Niacinamide, Ceramide AS, Panthenol, Ceramide NS, Arginine, Butylene Glycol, Hydrogenated Lecithin, Cetearyl Alcohol, Tocopherol, Stearic Acid, Ascorbic Acid, Sodium Hyaluronate, Cholesterol, Phytosphingosine', 'dry', 2, '2025-06-08 07:01:42', '2025-06-18 21:56:16', 12),
(27, 'Sensibio H20', 'BIODERMA', 'Cleanser', 'Pembersih wajah tanpa bilas untuk kulit sensitif, menjaganya agar sehat, nyaman dan membersihkan dari make-up dan polusi', 315000.00, 'products/gliC9eywC3xSSiy9Pt2JS1W5zYbbyS7aQCFxlVp5.png', 'Aqua/​Water/​Eau, Peg-6 Caprylic/​Capric Glycerides, Fructooligosaccharides, Mannitol, Xylitol, Rhamnose, Cucumis Sativus (Cucumber) Fruit Extract, Propylene Glycol, Cetrimonium Bromide, Disodium Edta', 'dry', 2, '2025-06-08 07:02:29', '2025-06-18 21:56:06', 3),
(28, 'Acne Control Cleanser', 'CeraVe', 'Cleanser', 'Refreshing gel-to-foam facial cleanser for blemish-prone skin, that helps to reduce the appearance of blemishes and blackheads, and removes excess oil while leaving the skin feeling soft and smooth. The formula penetrates pores to eliminate the cause of spots & blemishes, while respecting the skin’s natural barrier.', 397000.00, 'products/XN8bW5NRSECeqWe9h40AvcR746ksnHthpLtuNLMn.webp', 'Active Ingredients: Salicylic Acid (2%)\r\nInactive Ingredients: Water, Sodium Lauroyl Sarcosinate, Cocamidopropyl Hydroxysultaine, Glycerin, Niacinamide, Gluconolactone, Sodium Methyl Cocoyl Taurate, PEG-150 Pentaerythrityl Tetrastearate, Ceramide NP, Ceramide AP, Ceramide EOP, Carbomer, Calcium Gluconate, Triethyl Citrate, Sodium Benzoate, Sodium Hydroxide, Sodium Lauroyl Lactylate, Cholesterol, Tetrasodium EDTA, Caprylyl Glycol, Hydrolyzed Hyaluronic Acid, Trisodium Ethylenediamine Disuccinate, Xanthan Gum, Hectorite, Phytosphingosine, Benzoic Acid', 'dry', 2, '2025-06-08 07:03:30', '2025-06-18 21:55:54', 20),
(29, 'Peach Makes Perfect Lip Tint', 'NIVEA', 'Lip Balm', 'The formula of this flavored lip balm melts into your lips, leaving them moisturized for 24 hours. For lips with a delicious peach aroma and a subtle coral-pinkish shine: Peach Shine Lip Balm.', 73000.00, 'products/3dKpIaDDMQruYte2BdPTGNYhdDCrjm0LljkTaI0O.webp', 'Octyldodecanol, Ricinus Communis Seed Oil, Cera Alba, Butyrospermum Parkii Butter, Bis-Diglyceryl Polyacyladipate-2, Cocoglycerides, Hydrogenated Castor Oil, Aroma, Persea Gratissima Oil, Prunus Persica Juice, Tocopherol, Ascorbyl Palmitate, Aqua, Propylene Glycol, Mica, BHT, CI 77891, CI 15985, CI 15850', 'dry', 2, '2025-06-08 07:04:16', '2025-06-18 21:55:18', 4),
(30, 'Peach Makes Perfect Lip Tint', 'Barenbliss', 'Lipstain & Tint', 'A sweet peach scented lip tint that creates a stained and shiny lip with 6 Naturals Goodness and soft-lustrous color milky light gel.', 73000.00, 'products/OTFMMwcjXx2fc7570ElTGuaDjXbwSesxIIZzeeJZ.png', 'Isododecane, Synthetic Wax, Polybutene, Trimethylsiloxysilicate, Sucrose Tetrastearate Triacetate, Isoamyl Laurate, Silica, Hydrogenated Jojoba Oil, Cetearyl Behenate, Synthetic Fluorphlogopite, Pentaerythrityl Tetra-Di-T-Butyl Hydroxyhydrocinnamate, Ethylhexyl Palmitate, Kaolin, Trihydroxystearin, Sodium Hyaluronate, Colophonium/​Rosin/​Colophane.', 'dry', 2, '2025-06-08 07:05:03', '2025-06-18 21:54:59', 10),
(31, 'Lifter Liner Lip Liner Makeup with Hyaluronic Acid', 'Maybelline', 'Lip Liner', 'Meet Lifter Liner, Maybelline NY’s next level lip liner for long-lasting, easy-on color. Creamy and comfortable moisture-locking formula, this lip pencil delivers a smooth glide application without tugging. Available in 10 shades to combine with your favorite Lifter Gloss.', 175000.00, 'products/fdE4dTXvPDv4Fx1QCk4ar9OPWHuiI4qoOZ2CURPs.png', 'Isododecane, Synthetic Wax, Polybutene, Trimethylsiloxysilicate, Sucrose Tetrastearate Triacetate, Isoamyl Laurate, Silica, Hydrogenated Jojoba Oil, Cetearyl Behenate, Synthetic Fluorphlogopite, Pentaerythrityl Tetra-Di-T-Butyl Hydroxyhydrocinnamate, Ethylhexyl Palmitate, Kaolin, Trihydroxystearin, Sodium Hyaluronate, Colophonium/​Rosin/​Colophane.', 'dry', 2, '2025-06-08 07:06:07', '2025-06-18 21:54:38', 12),
(32, 'Airy Weary Lip Mousse Liquid Lipstick', 'Earth Rhythm', 'Lipstick', 'Available in 13 different shades to match every mood and persona, Airy Weary Lip Mousse is a multi-faceted product that simultaneously treats dry & chapped lips by delivering much needed hydration and making them look soft and plump. The high-pigmented formula glides on creamy and sets to a smooth matte finish.', 175000.00, 'products/cyPQTJgCtAWxwyQjwi7O73UQePq0rCgtt4GGfTDO.webp', 'Dimethicone, Cyclopentasiloxane, Dimethicone/Vinyl Dimethicone Crosspolymer, Aqua, Dimethicone Crosspolymer, Cetyl Peg/Ppg-10/1 Dimethicone, Ci 45410, Vinyl Dimethicone/Methicone Silsesquioxane Crosspolymer, Sorbitan Isostearate, Squalane, Polyglyceryl-2 Triisostearate, Acrylates/Dimethicone Copolymer, Ci 15850, Trimethylsiloxysilicate, Lauryl Peg/Ppg-18/18 Methicone, Cyclohexasiloxane, Tribehenin, Ci 77891, Niacinamide, Nelumbo Nucifera Flower Extract, Hyaluronic Acid, Simmondsia Chinensis (Jojoba) Seed Oil, Phenoxyethanol, Ethylhexylglycerin', 'dry', 2, '2025-06-08 07:07:03', '2025-06-18 21:53:17', 8),
(33, 'Dramatically Different Lipstick Shaping Lip Colour', 'Clinique', 'Lipstick', 'Hydrating lipstick infused with skincare for lips. Rich, long-wearing formula resists flaking and feathering for 8 hours.', 552000.00, 'products/tUcmsKLIMweLh8WsqWE200Txpx72lzeiGuy8llAn.webp', 'Cetyl Ethylhexanoate, Ozokerite, Ricinus Communis (Castor) Seed Oil, Polybutene, Beeswax\\Cera Alba\\Cire D\'Abeille, Polyethylene, PPG-51/​Smdi Copolymer, Silica, Microcrystalline Wax\\Cera Microcristallina\\Cire Microcristalline, Bis-Diglyceryl Polyacyladipate-2, Centella Asiatica (Hydrocotyl) Extract, Hibiscus Abelmoschus Extract, Coleus Barbatus Extract, Helianthus Annuus (Sunflower) Seed Oil, Butyrospermum Parkii (Shea Butter), Ethylhexyl Palmitate, Lecithin, Polyglyceryl-10 Heptahydroxystearate, Caprylyl Glycol, Dipalmitoyl Hydroxyproline, Palmitoyl Tripeptide-1, Tribehenin, Squalane, Hdi/​Trimethylol Hexyllactone Crosspolymer, Tocopheryl Acetate, Hydrogenated Polyisobutene, Sorbitan Isostearate', 'dry', 2, '2025-06-08 07:07:55', '2025-06-18 21:54:19', 3),
(34, 'Icon Velvet Liquid Lipstick', 'Fenty Beauty', 'Lipstick', 'Fall in love with a new kind of matte. The creamy, whipped texture hugs lips with intense color in one precise swipe. This unique formula leaves lips feeling plush and comfy and not dry.', 421500.00, 'products/Pr2OmvvamWm43puX7vp26NCWIcaTETGMnz7IkuzM.png', 'Dimethicone, Dimethicone/​Vinyl Dimethicone Crosspolymer, Isododecane, Polyglyceryl-2 Triisostearate, PEG-10 Dimethicone, Tribehenin, Disteardimonium Hectorite, Propylene Carbonate, Red 6 Lake (Ci 15850), Red 7 Lake (Ci 15850)', 'dry', 2, '2025-06-08 07:08:34', '2025-06-18 21:53:37', 4),
(35, 'Clean Fresh Brow Filler Pomade Eyebrow Pencil', 'CoverGirl', 'Eyebrows', 'A Covergirl brow pencil with an ultra-precise, beveled triangular precision tip for filled and shaped brows. An eyebrow pencil with a highly pigmented creamy pomade formula that glides effortlessly and precisely with a non-drying soft matte finish. Soft paddle-shaped kabuki brush to blend and soften the pigments in this waterproof eyebrow pencil. Clean, vegan formula infused with browcare ingredients like vitamin E, hyaluronic acid and squalane. All-day waterproof, sweat-proof, smudge-proof and transfer-proof wear that does not budge.', 143700.00, 'products/JJy1LsQMUnBxtqqlsthJy2Tn3UEvpIhDn7vDLVMl.png', 'Methyl Trimethicone, Synthetic Wax, Trimethylsiloxysilicate, Silica, Dicalcium Phosphate, Mica, Lauroyl Lysine, Octyldodecanol, C20-24 Alkyl Dimethicone, Copernicia Cerifera Cera/​Copernicia Cerifera (Carnauba) Wax/​Cire De Carnauba, Disteardimonium Hectorite, Propylene Carbonate, Caprylic/​Capric Triglyceride, Polyhydroxystearic Acid, Pentaerythrityl Tetra-Di-T-Butyl Hydroxyhydrocinnamate, Isostearic Acid, Lecithin, Polyglyceryl-6 Polyricinoleate, Squalane, Sodium Hyaluronate, Aqua/​Water/​Eau. May Contain: Ultramarines (Ci 77007), Iron Oxides (Ci 77491, Ci 77492, Ci 77499), Titanium Dioxide (Ci 77891)]', 'dry', 2, '2025-06-08 07:09:18', '2025-06-18 21:52:44', 12),
(36, 'Major Dimension Eye Illusion Eyeshadow Duo', 'Patrick Ta', 'Eyeshadow', 'A shimmering eyeshadow duo that illuminates eyes with super-fine sparkles and multidimensional pearl pigments.', 876000.00, 'products/3xBcZzWbRiTr7chd53cg9UW2jMdHLO3BTIhzqmBG.webp', 'Shade 1: Calcium Aluminum Borosilicate, Mica, Calcium Sodium Borosilicate, Calcium Titanium Borosilicate, Cetearyl Ethylhexanoate, Synthetic Fluorphlogopite, Glycerin, Silica, Hydrolyzed Rice Protein, Water/​Aqua/​Eau, Squalane, Calcium Chloride, Tin Oxide, Gellan Gum, Sodium Citrate, 1,2-Hexanediol, Sodium Isostearate, Xanthan Gum, Pentaerythrityl Tetra-Di-T-Butyl Hydroxyhydrocinnamate, Caprylyl Glycol, Polysorbate 20, Ethylhexylglycerin, Titanium Dioxide (Ci 77891), Iron Oxides (Ci 77491)\r\nShade 2: Synthetic Fluorphlogopite, Silica, Cetearyl Ethylhexanoate, Glycerin, Hydrolyzed Rice Protein, Water/​Aqua/​Eau, Squalane, Calcium Sodium Borosilicate, Calcium Chloride, Tin Oxide, Gellan Gum, Sodium Citrate, 1,2-Hexanediol, Sodium Isostearate, Xanthan Gum, Pentaerythrityl Tetra-Di-T-Butyl Hydroxyhydrocinnamate, Caprylyl Glycol, Polysorbate 20, Ethylhexylglycerin, Titanium Dioxide (Ci 77891), Iron Oxides (Ci 77491)', 'dry', 2, '2025-06-08 07:10:08', '2025-06-18 21:52:32', 6),
(37, 'Matte Liquid Eyeshadow', 'Kylie Cosmetics', 'Eyeshadow', 'Say hello to effortless eyeshadow that stays put for up to 12 hours. My matte liquid eyeshadow is a cream-to-powder texture that delivers blurred, soft-matte color without transferring, creasing, or fading throughout the day. This easy to build and blend formula dries to a comfortable, streak-free result.', 362000.00, 'products/dDTBvDdNwuaPJ3m7qeFvBRsDP41NJgjNNjNFMFmg.png', 'Isododecane, Water/​Aqua/​Eau, Polymethylsilsesquioxane, C24-28 Alkyldimethylsiloxy Trimethylsiloxysilicate, Cetyl PEG/​PPG-10/​1 Dimethicone, Alumina, Aluminum Starch Octenylsuccinate, Kaolin, Mica, Dimethicone, Disteardimonium Hectorite, Propylene Carbonate, Glycerin, 1,2-Hexanediol, Caprylyl Glycol, Hydroxyethyl Acrylate/​Sodium Acryloyldimethyl Taurate Copolymer, Dimethicone/​Bis-Isobutyl PPG-20 Crosspolymer, Albizia Julibrissin Bark Extract, Triethoxycaprylylsilane, Hydrogen Dimethicone, Polysorbate 60, Sorbitan Isostearate, Sodium Hydroxide, Sodium Benzoate, Darutoside, Pentaerythrityl Tetra-Di-T-Butyl Hydroxyhydrocinnamate, Tocopherol, Sodium Carbonate. May Contain: Titanium Dioxide (Ci 77891), Manganese Violet (Ci 77742), Iron Oxides (Ci 77491, Ci 77492, Ci 77499), Ultramarines (Ci 77007)', 'dry', 2, '2025-06-08 07:10:46', '2025-06-18 21:52:21', 15),
(38, 'Glam & Doll Easy Wash Off Power Hold Volume Mascara', 'Catrice', 'Mascara', 'Long-lasting volume mascara, can easily be removed with warm water', 182000.00, 'products/ZnvXfdHpFqgCJBOQ4LeJvYQSpFSJyXVmoONpV2zn.png', 'Aqua (Water), Copernicia Cerifera (Carnauba) Wax, Synthetic Beeswax, Butylene Glycol, Polyurethane-35, Glyceryl Stearate, PEG-100 Stearate, Cetearyl Alcohol, Stearic Acid, Kaolin, Palmitic Acid, Acacia Senegal Gum, Tocopherol, Ethylhexylglycerin, Hydroxyethylcellulose, Methylpropanediol, Polyester-4, Caprylyl Glycol, Phenylpropanol, Sodium Nitrate, Potassium Hydroxide, Phenoxyethanol, Potassium Sorbate, Sodium Benzoate, Sodium Dehydroacetate, Ci 77499 (Iron Oxides)', 'dry', 2, '2025-06-08 07:11:39', '2025-06-18 21:51:57', 16),
(39, 'Fullest Volumizing Mascara', 'ILIA', 'Mascara', 'Fullest Volumizing Mascara thickens and defines lashes from root to tip with fullness you can’t miss. Clean, nourishing ingredients condition with every coat for lashes that look fuller and thicker. The flake-resistant formula washes off easily with your favorite cleanser—no scrubbing, tugging, or heavy-duty makeup remover needed. Fullest Volumizing Mascara is ophthalmologist-tested, safe for sensitive eyes, and safe for contact lens wearers.', 550210.00, 'products/CHepKRgdcESfyRrBgnsjPwHmjLblD1j6s7E4ZKcq.png', 'Aqua/Water/Eau, Cera Alba/Beeswax/Cire d\'abeille, Synthetic Beeswax, Glyceryl Stearate, Glycerin, Cera Carnauba/Copernicia Cerifera (Carnauba) Wax/Cire de Carnauba, Dimer Dilinoleyl Dimer Dilinoleate, Stearic Acid, Palmitic Acid, Ethylhexyl Polyhydroxystearate, Polyglyceryl-6 Polyricinoleate, Jojoba Esters, Acacia Senegal Gum, Panthenol, Benzyl Alcohol, Caprylyl Glycol, Sodium Hydroxide, Xanthan Gum, Caprylhydroxamic Acid, Arginine, Lauric Acid, Myristic Acid, Arachidic Acid, Oleic Acid, Tocopherol. May Contain/Peut Contenir (±): CI 77499 (Iron Oxide).', 'dry', 2, '2025-06-08 07:18:31', '2025-06-18 21:51:48', 8),
(40, 'Scandal Waterproof Retractable Eyeliner', 'SOMETHINC', 'Eyeliner', 'Eyeliner waterproof yang mampu memberikan warna pekat dalam sekali goresan! Diformulasikan agar water resistant, tidak geser, dan tahan lama. Dilengkapi dengan sharpener yang bisa dipakai kapanpun untuk mempertajam creamy gel eyeliner ini.', 73500.00, 'products/mEdbLGbBQMuy7DurDeI0bpL772qLR6rv6ZUqZF0S.png', 'Dimethicone, Trimethylsiloxysilicate, Synthetic Wax, Phenylpropyldimethylsiloxysilicate, Isodecyl Neopentanoate, Euphorbia Cerifera (Candelilla) Wax, Microcrystalline Wax, Phenoxyethanol, Tocopheryl Acetate, Ci 77499, Ci 77510, Ci 77266', 'dry', 2, '2025-06-08 07:19:25', '2025-06-18 21:51:29', 5),
(41, 'Clear Cut Liquid Eyeliner', 'HAUS LABS', 'Eyeliner', 'A clean, carbon black-free liquid eyeliner delivering the blackest black*, long-lasting matte finish in a custom, calligraphy-inspired brush.', 673500.00, 'products/k95hJsvlJpz1xDIYQJEq9WrG87dL2ajij2GkL27L.webp', 'Aqua (Water, Eau), Charcoal Powder, Ammonium Styrene/​Acrylates Copolymer, Butylene Glycol, 1,2-Hexanediol, Glycerin, Campsis Grandiflora Flower Extract, Eclipta Prostrata Extract, Paeonia Suffruticosa Root Extract, Panthenol, Pentylene Glycol, Caprylyl Glycol, Ethylhexylglycerin, Sodium Dilauramidoglutamide Lysine, Iodopropynyl Butylcarbamate', 'dry', 2, '2025-06-08 07:25:15', '2025-06-18 21:51:18', 15),
(42, 'Blush Is Life Baked Talc-Free Dimensional + Brightening Blush', 'Kosas', 'Blush', 'A clean, silky-smooth talc-free powder blush baked with squalane + hyaluronic acid in dimensional color duos for a healthy flush of color.', 673500.00, 'products/IbyHS65GBrPC7yOHPyU9iaU1qUsrug9963olUOQN.webp', 'Mica, Synthetic Fluorphlogopite, Kaolin, Squalane, Jojoba Esters, Octyldodecanol, Hectorite, Silica, Ethylhexylglycerin, Aluminum Hydroxide, Sodium Acetylated Hyaluronate, Potassium Sorbate, Tin Oxide, Tocopherol [+/-: CI 15850 (Red 7 Lake), CI 45410 (Red 27 Lake), CI 77007 (Ultramarines), CI 77163 (Bismuth Oxychloride), CI 77491, CI 77492, CI 77499 (Iron Oxides), CI 77891 (Titanium Dioxide)] 4.5g / 0.16 oz', 'dry', 2, '2025-06-08 07:26:08', '2025-06-18 21:51:02', 6),
(43, 'Colorstay UV Primer', 'Revlon', 'Primer', 'A UV primer with SPF 40/ PA+++. Comfortable, lightweight formula that lasts up to 24 hours. Suitable for all skin types.', 264000.00, 'products/YXdlGoFmOK7pSdFLLQYIPA1VPB7sP0ixPZ7CVUdp.png', 'Cyclopentasiloxane, Aqua, Zinc Oxide, Ethylhexyl Methoxycinnamate, Trimethylsiloxysilicate, Glycerin, Titanium Dioxide, PEG-10 Dimethicone, PEG-9 Polydimethylsiloxyethyl Dimethicone, Dimethicone, Polymethylsilsesquioxane, Hdi/​Trimethylol Hexyllactone Crosspolymer, Hexyl Laurate, Polyglyceryl-4 Isostearate, Citrullus Lanatus Fruit Extract, Lens Esculenta Fruit Extract, Pyrus Malus Fruit Extract, Salicylic Acid, Tocopheryl Acetate, Perlite, Dimethicone/​PEG-10/​15 Crosspolymer, Xanthan Gum, Magnesium Sulphate, Stearic Acid, Alumina, Polysilicone-11, Sodium Lactate, Sodium PCA, Tetrasodium EDTA, Triethoxycaprylylsilane, Ethylhexyl Palmitate, Butylene Glycol, Silica Dimethyl Silylate, Phenoxyethanol, Caprylyl Glycol, 1,2-Hexanediol, Ci 77499', 'dry', 2, '2025-06-08 07:37:38', '2025-06-18 21:50:03', 18),
(44, 'Matte My Day Hydraveil Primer Serum', 'Azarine', 'Primer', 'Make up primer + serum dengan matte finish yang sekaligus dapat merawat kulit terutama untuk melembabkan kulit. Primer ringan ini MEDIUM to HIGH coverage mampu menyamarkan pori / garis halus / kemerahan pada wajah. Diformulasikan dengan bahan aktif alami untuk membantu mengontrol minyak / sebum sekaligus merawat skin barrier kulit.', 86470.00, 'products/CGaWv6UX09CI6h2Own8wtjgWVNBGJHGjffWMWIoa.webp', 'Dimethicone/​Vinyl Dimethicone Crosspolymer, Cyclopentasiloxane, Polymethyl Methacrylate, Niacinamide, Phenoxyethanol, Allantoin, Sodium Hyaluronate, Ceramide 3, Tocopheryl Acetate, Panthenol, Centella Asiatica Extract', 'dry', 2, '2025-06-08 07:42:13', '2025-06-18 21:49:41', 6),
(45, 'Prime Time Foundation Primer', 'bareMinerals', 'Primer', '-', 503000.00, 'products/o5f0tSEn8GWH2PrgyzE8mpdkY5QNB06GV3CFNZ3J.png', 'Cyclopentasiloxane, Dimethicone Crosspolymer, Dimethicone, Silica, Magnesium Silicate, Ascorbic Acid (Vitamin C), Tocopherol (Vitamin E), Pantothenic Acid (Vitamin B5), Aloe Barbadensis Leaf Extract, Chamomilla Recutita Flower Extract, Glycyrrhiza Glabra (Licorice) Extract', 'dry', 2, '2025-06-08 07:43:14', '2025-06-18 21:49:09', 8),
(46, 'Airbrush Bronzer', 'Charlotte Tilbury', 'Bronzer', 'An oversized natural matte bronzer in a refillable compact, infused with hyaluronic acid for a skin-perfecting bronzed filter for the face and body.', 767219.00, 'products/P7qPvSRmIphcad5z48X27UIICRHNruSMlUm9GGqA.png', 'Talc, Mica, Methyl Methacrylate Crosspolymer, Dimethicone, Nylon-12, Silica, Zinc Stearate, Pentaerythrityl Tetraisostearate, Ethylhexylglycerin, Lauroyl Lysine, Potassium Sorbate, Dimethiconol, Hyaluronic Acid, Hydroxystearic Acid, [+/- Iron Oxides (Ci 77491, Ci 77492, Ci 77499)].', 'dry', 2, '2025-06-08 07:44:27', '2025-06-18 21:48:09', 11),
(47, 'Sunside Bronzer', 'Sheglam', 'Bronzer', 'Have the sun on your side! Our light-as-air pressed powder instantly adds natural dimension to your complexion, plus a soft sunkissed look without uneven patches or harshlines!', 382500.00, 'products/WBc69pV4eR8NtjGrJN8glyF0xDqLAQvMHkujPka0.jpg', 'Talc, Mica, Alumina, Lauroyl Lysine, Silica, Triethylhexanoin, Diisostearyl Malate, Kaolin, Dimethicone, Phenoxyethanol, Sorbitan Isostearate, Magnesium Myristate, Caprylyl Glycol, Triethoxycaprylylsilane, Iron Oxides (Ci 77492, Ci 77491, Ci 77499)', 'dry', 2, '2025-06-08 07:50:17', '2025-06-18 21:47:56', 2),
(48, 'Loose Setting Powder', 'Anastasia Beverly Hills', 'Powder', 'Anastasia Beverly Hills Loose Setting Powder perfects, brightens and sets makeup in place with ease. This lightweight, superfine powder formula goes on smoothly as it absorbs oil, minimizes shine and leaves you with a flawless matte finish. Available in 4 natural-toned shades and 1 universal translucent powder shade, this silky formula gives the complexion a seamless, soft-focus effect, blurs the look of imperfections and extends the wear of your makeup.', 773000.00, 'products/oHjkAxLn0n6vM5k1REzzJ5NFIIowILlLHNJ3Rihm.png', 'Talc, Mica, Vinyl Dimethicone/​Methicone Silsesquioxane Crosspolymer, Aluminum Starch Octenylsuccinate, Ethylhexylglycerin, Lauroyl Lysine, Ethylhexyl Palmitate, Caprylic/​Capric Triglyceride, Phenoxyethanol', 'dry', 2, '2025-06-08 07:51:15', '2025-06-18 21:47:37', 7),
(49, 'ColorStay Pressed Powder', 'REVLON', 'Powder', 'Silky, ultra-fine formula which blends easily for a flawless, shine-free finish finish that lasts all day.', 375000.00, 'products/N0uZcGBqdEYz6HzBx4IfLRtJpX9DVKI6uxscL4DM.png', 'Talc, Zinc Stearate, C12-15 Alkyl Benzoate, Zea Mays (Corn) Starch, Polyethylene, Phenyl Trimethicone, Nylon-12, Kaolin, Synthetic Fluorphlogopite, Lecithin, Methicone, Triethoxycaprylylsilane, Silica, Phenoxyethanol, Ethylhexylglycerin', 'dry', 2, '2025-06-08 07:52:01', '2025-06-18 21:47:29', 7),
(50, 'Fix and Flawless Acne Cover Cushion', 'Sea Makeup', 'Cushion', 'Sea Makeup Fix and Flawless Acne Cover Cushion merupakan Cushion Foundation yang dilengkapi dengan salicylic acid, niacinamide dan ekstrak bunga red clover menjadikan SEA Makeup Fix dan Flawless Acne Cover Cushion produk makeup yang diformulasikan khusus sebagai makeup yang memiliki fungsi utama pencegahan dan perawatan jerawat. Cushion foundation ini memiliki coverage medium hingga high yang dapat menyembunyikan tampilan pori-pori dan garis halus dengan Skin Matte Finish dengan formula tahan lama yang nyaman digunakan sepanjang hari dengan oil control power yang optimal, juga membantu merawat dan mencegah jerawat. Kandungan SPF 35 dan PA+++ dari cushion ini dapat melindungi wajah dari bahaya paparan sinar matahari. Diformulasikan agar tidak mudah teroksidasi meski digunakan seharian. How to use:Dengan menggunakan aplikator puff, tekan perlahan ke spons bantalan yang telah dikeluarkan foundation sebelumnya. Untuk coverage yang maksimal, tepuk-tepuk secara merata di seluruh wajah. Untuk coverage yang ringan, ratakan pada wajah menggunakan gerakan menyapu. Suitable for:Semua jenis kulit.Ingredients:Salicylic Acid, Niacinamide, Red Clover Flower, SPF 35 PA+++', 253000.00, 'products/esZ6VRpeDHpOH1XokcTAXRbwGhoHSZS3t5I55wMQ.png', 'Aqua, Methylpropanediol, Cyclopentasiloxane, Cyclohexasiloxane, Ethylhexyl Methoxycinnamate, Octocrylene, Isododecane, C12-15 Alkyl Benzoate, Disteardimonium Hectorite, Silica, Cetyl PEG/​PPG-10/​1 Dimethicone, Cetyl Dimethicone, Lauryl PEG-9 Polydimethylsiloxyethyl Dimethicone, Biosaccharide Gum-1, Hydroxyacetophenone, PEG-10 Dimethicone/​Vinyl Dimethicone Crosspolymer, Sodium Chloride, Tocopherol, Sodium Hyaluronate, Trimethylsiloxysilicate, Dimethicone, Salicylic Acid, Niacinamide, Ceramide 3, Maltodextrin, Lactobacillus Ferment, Tocopheryl Acetate, Ubiquinone, Arginine, 1,2-Hexanediol, Pentylene Glycol, Soluble Collagen, Phenoxyethanol, Ethylhexylglycerin, Titanium Dioxide, Yellow Iron Oxide, Red Iron Oxide, Black Iron Oxide, Triethoxycaprylylsilane, Trifolium Pratense (Clover) Flower Extract, Galactomyces Ferment Filtrate', 'dry', 2, '2025-06-08 07:53:06', '2025-06-18 21:46:14', 7),
(51, 'Solar Smart UV Cushion', 'Carasun', 'Cushion', 'Carasun Solar Smart UV - Sun Cushion SPF 50+ dan PA++++, merupakan inovasi 2-in-1 antara sunscreen atau tabir surya atau sunblock dan tinted foundation dalam bentuk BB cushion. Memiliki soft matte finish dengan medium coverage sehingga dapat menjadi alas bedak yang memberikan hasil second skin look yang terlihat fresh hingga 8 jam. Sudah teruji pada test in-vivo sehingga terbukti dapat melindungi wajah dari 98% bahaya sinar UV. Produk mengandung bluelight protection yang juga dapat melindungi bahaya sinar radiasi dari gadget yang kita gunakan sehari - hari. Cocok digunakan untuk touch-up alas bedak serta reaplikasi sunscreen yang efektif dengan anti-bacterial puff! Cushion mengandung kandungan skincare seperti Centella Asiatica, niacinamide, serta Rice Oil yang dapat memberikan efek soothing setelah terpapar bahaya sinar matahari sepanjang hari. Cushion untuk semua jenis kulit (berminyak, kering, kombinasi), aman untuk kulit sensitif serta non-comedogenic. Tersedia dalam 6 warna yang cocok untuk semua skintone wanita tropis. Tersedia dalam bentuk refill.', 120000.00, 'products/a1GnswhHYB760wD5tACspi7fNZcscNg6v8G2Voqz.png', 'Water, Glycerin, Dibutyl Adipate, Butyloctyl Salicylate, Diethylamino Hydroxybenzoyl Hexyl Benzoate, Bis-Ethylhexyloxyphenol Methoxyphenyl Triazine, Methyl Methacrylate Crosspolymer, Polysilicone-15, Silica, Ethylhexyl Triazone, Pentylene Glycol, Isoamyl p-Methoxycinnamate, Inulin Lauryl Carbamate, Sodium Acrylate/​Sodium Acryloyldimethyl Taurate Copolymer, Acrylates/​C10-30 Alkyl Acrylate Crosspolymer, Tromethamine, Betaine, Isohexadecane, Glyceryl Caprylate, Butylene Glycol, Caprylyl Glycol, Allantoin, Niacinamide, Oryza Sativa (Rice) Bran Oil, Adenosine, Tocopheryl Acetate, Polysorbate 80, Sorbitan Oleate, Anthemis Nobilis Flower Extract, Lactic Acid, 1,2-Hexanediol, Rosmarinus Officinalis (Rosemary) Leaf Extract, Centella Asiatica Extract, Palmitoyl Tetrapeptide-7, Caffeine, Chrysin', 'dry', 2, '2025-06-08 07:53:43', '2025-06-18 21:46:02', 4),
(52, 'CC+ Cream Natural Matte Foundation with SPF 40', 'It Cosmetics', 'BB & CC Cream', 'Tackle oily skin concerns with your hydrating, full-coverage matte foundation — that won’t leave your skin looking one-dimensional or dry. With a pore-refining, natural matte (never flat!) finish, our matte CC cream conceals the look of uneven skin tone, facial redness, blemishes and more while delivering all-day hydration to your oily and combination skin.', 847000.00, 'products/EBegS5XDLqfN4VeSztlxljrFvAbl1cb9HsTOgias.png', 'Aqua/​Water/​Eau, Dimethicone, Isododecane, Ethylhexyl Salicylate, Butylene Glycol, Silica, Cetyl PEG/​PPG-10/​1 Dimethicone, Glycerin, Isohexadecane, Phenylbenzimidazole Sulfonic Acid, Titanium Dioxide [Nano], Titanium Dioxide, Niacinamide, Trimethylsiloxysilicate, Synthetic Fluorphlogopite, Butyloctyl Salicylate, Dimethicone Crosspolymer, Sodium Chloride, Aluminum, Starch, Octene, Succinate, Phenoxyethanol, Silica Silylate, Disodium Stearoyl Glutamate, Sorbitan Isostearate, Polyglyceryl-4 Isostearate, Sodium Hydroxide, Aluminum Hydroxide, Hexyl Laurate, Stearic Acid, Chlorphenesin, Caprylyl Glycol, Lens Esculenta Seed Extract/​Lentil Seed Extract, Trisodium Ethylenediamine Disuccinate, Sodium Hyaluronate, Tocopherol, Adenosine, Kaolin, Ethylhexylglycerin, Steareth-20, Pentaerythrityl Tetra-Di-T-Butyl Hydroxyhydrocinnamate, Chlorhexidine Digluconate, N-Hydroxysuccinimide, Sodium Citrate, Potassium Sorbate, Palmitoyl Tripeptide-1, Chrysin, Palmitoyl Tetrapeptide-7, Citric Acid, Biotin', 'dry', 2, '2025-06-08 07:57:21', '2025-06-18 21:45:40', 5),
(53, 'Flawless CC Cream', 'Neutrogena', 'BB & CC Cream', 'Get a flawless looking complexion with Neutrogena Clear Coverage Flawless Matte CC Cream. Available in 34 natural-looking shades, this color correcting cream makeup from a dermatologist recommended brand provides full, matte coverage, designed to mask imperfections and even skin tone. The mattifying foundation was developed with dermatologists for acne prone skin and is formulated with niacinamide (b3) and is hypoallergenic, free of oil, fragrance, parabens, and phthalates. This breathable formula feels comfortable on skin, blurs the look of discoloration and redness, and leaves skin feeling soft and smooth.', 197000.00, 'products/Mk1Bdy77T79O9q5s7YNzG6IDe5LzQOLSYlSOAqFC.jpg', 'Water, Caprylic/​Capric Triglyceride, Cetyl Ethylhexanoate, Butylene Glycol Dicaprylate/​Dicaprate, Dimethicone, Methyl Trimethicone, Cetyl PEG/​PPG-10/​1 Dimethicone, Pentylene Glycol, Butylene Glycol, Silica, Sodium Chloride, Disteardimonium Hectorite, Niacinamide, Glycerin, Lauryl PEG-10 (Trimethylsiloxy) Trissilylethyl Dimethicone, Phenoxyethanol, Sorbitan Isostearate, Triethoxycaprylylsilane, Caprylyl Glycol, Glyceryl Tribehenate/​Isostearate/​Eicosandioate, Aluminum Hydroxide, Ethylhexylglycerin, Disodium EDTA, Titanium Dioxide, Iron Oxides, Mica', 'dry', 2, '2025-06-08 07:58:24', '2025-06-18 21:44:29', 12),
(54, 'Essentials BB Cream', 'NIVEA', 'BB & CC Cream', '24H moisture: NIVEA Daily Essentials BB Cream provides skin with the hydration it needs for 24 hours, providing you with a face moisturiser that lasts all day. Illuminates complexion: Fine micro-colour pigments help to provide an even skin tone that is ideal for light skin tones and refines the appearance of pores. Natural formula: Contains minerals, bio jojoba oil, and provitamin B5. The minerals work to blend the cream giving skin a natural, healthy-looking glow.How to apply: A day cream that  evens, covers, illuminates, moisturises and protects skin all in one easy, dermatologically approved, application. Sunlight protection: Helps to protect the skin from sunlight, induced environmental influences and premature ageing with SPF 20.', 237000.00, 'products/pSSPczhrkCYcu4OCmBmTx8cNFGkDIvH9UhA1bsE2.jpg', 'Aqua, Glycerin, Cetearyl Alcohol, Methylpropanediol, Tapioca Starch, C12-15 Alkyl Benzoate, Dicaprylyl Ether, Sodium Phenylbenzimidazole Sulfonate, Butyl Methoxydibenzoylmethane, Octocrylene, Hydrogenated Coco-Glycerides, Octyldodecanol, Glycyrrhiza Inflata Root Extract, Vitis Vinifera Seed Oil, Panthenol, Glyceryl Glucoside, Carbomer, Ethylhexylglycerin, Sodium Stearoyl Glutamate, Sodium Chloride, Trisodium EDTA, Phenoxyethanol, Piroctone Olamine.', 'dry', 2, '2025-06-08 07:59:10', '2025-06-18 21:44:15', 3),
(55, 'Lightening BB Cream', 'Wardah', 'BB & CC Cream', 'Triple Lightening System pada Wardah Lightening BB Cream yang memberikan Long Lasting Effect, dapat membuat kulit tampak lebih cerah bercahaya, membantu menyamarkan ketidaksempurnaan, warna kulit tidak merata, melembapkan kulit, membuat kulit terlihat lebih halus, dan mengandung oil control. Aman bagi kulit sensitif dan cocok untukmu yang memiliki kulit kusam!', 42500.00, 'products/CmmYSR6DCuMty7cTW8k6wb0jwaNovLmQ4T4OEnTe.png', 'Aqua, Cyclopentasiloxane, Ethylhexyl Methoxycinnamate, Butylene Glycol, Dimethicone, Isododecane, Niacinamide, Dimethicone Crosspolymer, Stearic Acid, Caprylyl Methicone, Cyclomethicone, Ethylhexyl Palmitate, Polyglyceryl-4 Isostearate, Aloe Barbadensis (Aloe Vera) Leaf Extract, Sodium Chloride, Triethylhexanoin, Zinc Oxide, Disteardimonium Hectorite, Cetyl PEG/​PPG-10/​1 Dimethicone, Hexyl Laurate, Silica, Phenoxyethanol, Dimethicone/​Vinyl Dimethicone Crosspolymer, Sorbitan Olivate, Propylene Carbonate, Titanium Dioxide, Nylon-12, Tocopheryl Acetate, Glycerin, Allantoin, Triethoxycaprylylsilane, Ethylhexylglycerin, Ascorbyl Tetraisopalmitate, Disodium EDTA, Sodium Hyaluronate, Glycyrrhiza Glabra (Licorice) Root Extract, Carbomer, Polysorbate 20, Palmitoyl Pentapeptide-4, Trimethylsiloxysilicate, Aluminum Hydroxide, Methicone', 'dry', 2, '2025-06-08 07:59:54', '2025-06-18 21:44:01', 4),
(56, 'Infallible GALAXY lumiere Holographic Highlighter', 'LOREAL Paris', 'Highlighter', 'Elevate your glow with this skin-conditioning liquid highlighter, designed to give your skin luminosity. The lightweight, buildable formula feels like a second skin, blending effortlessly for a natural or bold glow.', 270000.00, 'products/3qlFXtYDXezfsk3EcQmGIRFmaInGGWGwyD4ZFKFE.jpg', 'Ethylhexyl Palmitate, Polyethylene, Hydrogenated Polyisobutene, Phenyl Trimethicone, Diisostearyl Malate, Calcium Aluminum Borosilicate, Ozokerite, Calcium Sodium Borosilicate, Bis-Diglyceryl Polyacyladipate-2, Silica, Disteardimonium Hectorite, Caprylyl Glycol, Tin Oxide, Methyl Methacrylate Crosspolymer, Tocopheryl Acetate, Nylon-12, Propylene Carbonate, Zinc Pca, Pentaerythrityl Tetra-Di-T-Butyl Hydroxyhydrocinnamate, Aqua/​Water/​Eau, Tocopherol. May Contain: Ci 77891/​Titanium Dioxide, Mica', 'dry', 2, '2025-06-08 08:00:53', '2025-06-18 21:50:44', 11),
(57, 'Glow Tape Highlighter', 'Tarte', 'Highlighter', 'Elevate your glow with this skin-conditioning liquid highlighter, designed give your skin luminosity. The lightweight, buildable formula feels like a second skin, blending effortlessly for a natural or bold glow.', 530000.00, 'products/cAuwS1XwIpuhxllOb2ohjpbGRrApK7jWSuSTTAWB.png', 'Water/​Aqua/​Eau, Hydrogenated Didecene, Isododecane, Mica, Glycerin, Propanediol, Cetyl PEG/​PPG-10/​1 Dimethicone, Silica, Sodium Chloride, Phenoxyethanol, Hydrogenated Styrene/​Isoprene Copolymer, Diamond Powder, Mangifera Indica (Mango) Seed Butter, Shea Butter Ethyl Esters, Hoya Lacunosa Flower Extract, Glycyrrhiza Glabra (Licorice) Root Extract, Polyglyceryl-4 Isostearate, Triethoxycaprylylsilane, Sodium Dehydroacetate, Trisodium Ethylenediamine Disuccinate, Caprylic/​Capric Triglyceride, Tropolone, Polymethylsilsesquioxane, Pentaerythrityl Tetra-Di-T-Butyl Hydroxyhydrocinnamate, Citric Acid May Contain: Iron Oxides (Ci 77491), Titanium Dioxide (Ci 77891)', 'dry', 2, '2025-06-08 08:01:43', '2025-06-18 21:50:35', 10),
(58, 'RoseGlow Liquid Highlighter', 'Laura Mercier', 'Highlighter', 'Keep the Glow going with new additions to the best selling Laura Mercier RoseGlow Collection​. Three special edition shades of a new sparkling Highlighter will bring the perfect Color & Shine to every skin tone​. Each shade is infused with our RoseGlow Pearl Blend, a unique mix of pearls inspired from rose gold metal that self-adjusts to anyone’s complexion for the perfect nude shade.​ Its unique blend of warm and cool tones brings life and light to your makeup in the most sophisticated way.​ This superior liquid formulation balances coverage and comfort with soft silica powders for a blurring finish and sensorial oils for lasting lightweight wear. Infused with our RoseGlow Pearl Blend for the perfect highlighting shades for all skin tones.', 647500.00, 'products/9KkysbKz8FeMVM2p2gtbbbaAHBYKnFRlZyXNANVb.webp', 'Water (Aqua/​Eau), Hydrogenated Didecene, Isododecane, Mica, Glycerin, Propanediol, Cetyl PEG/​PPG-10/​1 Dimethicone, Silica, Sodium Chloride, Hydrogenated Styrene/​Isoprene Copolymer, Hydroxyacetophenone, Polyglyceryl-4 Isostearate, 1,2-Hexanediol, Caprylyl Glycol, Triethoxycaprylylsilane, Trisodium Ethylenediamine', 'dry', 2, '2025-06-08 08:02:28', '2025-06-18 21:50:20', 3),
(59, 'Spotless Second Skin Serum Concealer', 'Mad for Makeup', 'Concealer', 'No CreaseUltra LightHigh Enough to cover dark spots & acne scars3% Cica + 2% B3 + HA SerumAcne Safe & CleanLong LastingWaterproofHalalCreaseless & Eyebag-lessAcne Safe & CleanLong lasting & WaterproofPigmented Enough to CoverLight enough to LayerSerum that Brightens & Hydrates 8g - BPOM RegisteredPAO 6 months.#ByeCreaseHiCover', 139500.00, 'products/n5sbLESRI6TcImLkTHELaDNva98i8srVnUiECmh9.png', 'Aqua, Ci 77891, Isohexadecane, Hydrogenated Polydecene, Methyl Methacrylate Crosspolymer, Glycerin, Trimethylsiloxysilicate, Polyglyceryl-3 Polyricinoleate, Lauroyl Lysine, Niacinamide, Propanediol, Silicon Dioxide, Butylene Glycol, Magnesium Stearate, Sorbitan Sesquioleate, Squalane, Ci 77492, Phenoxyethanol, Aloe Barbadensis Extract, Polyglyceryl-3 Diisostearate, Propylene Glycol, Trehalose, Aluminum Hydroxide, Hydrogen Dimethicone, VP/​Hexadecene Copolymer, Ci 77491, Allantoin, Glyceryl Tribehenate/​Isostearate/​Eicosandioate, Glycyrrhiza Glabra (Root) Extract, Centella Asiatica Leaf Extract, Disteardimonium Hectorite, Salicylic Acid, Amylopectin, Octyldodecanol, Ci 77499, Chamomilla Recutita (Matricaria) Flower Extract, Dextrin, Disodium EDTA, Ethylhexylglycerin, Hyaluronic Acid, Xanthan Gum, Triethoxycaprylylsilane, Hydrolyzed Royal Jelly Protein', 'dry', 2, '2025-06-08 08:03:29', '2025-06-18 21:46:51', 9),
(60, 'Instant Cover Concealer', 'Luxcrime', 'Concealer', 'A super creamy, skincare-packed concealer with full coverage and a fresh, hydrated, radiant finish. This weightless formula blends easily, blurs the appearance of dark spots and brightens under eyes. Enriched with Caffeine, Peptides and Green Tea Extract that helps brighten while retaining moisture. Crease-resistant and transfer-proof.', 96000.00, 'products/9xWEcQ7lRZGiRscR7kT9ir4O1QT1vrbPV8QZY7cp.png', 'Water, Cyclopentasiloxane, Titanium Dioxide, Synthetic Fluorphlogopite, Cetyl Ethylhexanoate, Glycerin, Trimethylsiloxysilicate, Lauryl PEG-10 Tris(Trimethylsiloxy)silylethyl Dimethicone, Butylene Glycol, Niacinamide, Diisostearyl Malate, Methyl Trimethicone, Pentylene Glycol, Polypropylsilsesquioxane, PEG-10 Dimethicone, Disteardimonium Hectorite, Magnesium Sulfate, Phenoxyethanol, Triethoxycaprylylsilane, Nylon-12, C30-45 Alkyldimethylsilyl Polypropylsilsesquioxane, Aluminum Hydroxide, Cetearyl Dimethicone/Vinyl Dimethicone Crosspolymer, Centella Asiatica Leaf Water, Ethylhexylglycerin, Disodium EDTA, Tocopherol, Caffeine, Camellia Sinensis Leaf Extract, 1,2-Hexanediol, Copper Tripeptid.', 'dry', 2, '2025-06-08 08:04:18', '2025-06-18 21:46:43', 5),
(61, 'Anti-Fatique Liquid Concealer', 'Yves Rocher', 'Concealer', 'The Liquid Concealer provides flawless coverage and a natural glow to the skin. The fluid texture is easy to apply and adapts perfectly to skin tone, giving radiance to the eye area. Contains Cornflower Water with soothing properties and is suitable for sensitive eyes. Beauty tip from YvesRocher: for a more effective result, apply the Liquid Concealer under the eyes in the shape of an inverted triangle. This will hide dark circles and make your eyes look even more radiant! Directions for use: Using the applicator, apply concealer directly to the skin under the eyes or to the area of skin imperfections. Blend it with your fingertips or makeup accessories.', 570000.00, 'products/6pKccfWMfIOMo2cZX9qPL2MMPaux8PWeyTTUgFne.webp', 'Aqua/​Water/​Eau, Dicaprylyl Carbonate, Mica, Cetearyl Isononanoate, Pentylene Glycol, Glycerin, PEG-45/​Dodecyl Glycol Copolymer, Vinyl Dimethicone/​Methicone Silsesquioxane Crosspolymer, Centaurea Cyanus Flower Water, Dimethicone, Hydrogenated Coco-Glycerides, Hydrogenated Vegetable Oil, Isododecane, Polyglyceryl-3 Ricinoleate, Silica, Magnesium Sulfate, Lecithin, PEG-30 Dipolyhydroxystearate, Aphloia Theiformis Leaf Extract, Hydrogenated Lecithin, Hydroxyacetophenone, Tocopheryl Acetate, Dimethicone Crosspolymer, Ethylhexylglycerin, Xanthan Gum, Sodium Benzoate, Citric Acid, Potassium Sorbate, Tocopherol, Alumina, Magnesium Oxide, Propylene Glycol, Ci 77491 (Iron Oxides), Ci 77492 (Iron Oxides), Ci 77499 (Iron Oxides), Ci 77891 (Titanium Dioxide)', 'dry', 2, '2025-06-08 08:05:09', '2025-06-18 21:46:33', 11),
(62, 'Total protection Face Shield Flex SPF 50', 'Colorescience', 'Tinted Moisturizer', 'A lightweight mineral sunscreen with tinted color coverage immediately evens skin tone for a flawless look. This hydrating, antioxidant-rich all-mineral actives formula is powered by patented EnviroScreen® Technology - which means comprehensive defense against UVA/UVB, Blue Light, Pollution, and Infrared radiation, combined with advanced antioxidants and nourishing, hydrating ingredients for long-term skin health. FLEX features innovative, iron oxide pigments that bloom in your fingertips to deliver tone-adapting buildable color coverage with a demi-matte finish. Available in six uniquely flexible shades, each ideal for a broad range of skin tones and under tones. Safe for all skin types, including sensitive. If you are not sure between two shades, we recommend selecting the lighter shade.', 995000.00, 'products/YU1U88e7lxF7nBOYcuQBHGyRA6N2aVB1WhahT4dq.webp', 'Active Ingredients: Zinc Oxide (12%) Inactive Ingredients: Water, C12-15 Alkyl Benzoate, Butyloctyl Salicylate, Lauryl PEG-8 Dimethicone, Isododecane, Propanediol, Caprylyl Methicone, Dimethicone, Niacinamide, Tridecyl Salicylate, Dimethicone/​Vinyl Dimethicone Crosspolymer, Trilaureth-4 Phosphate, Dimethiconol/​Propylsilsesquioxane/​Silicate Crosspolymer, Lauryl PEG-10 Tris(Trimethylsiloxy)silylethyl Dimethicone, Mica, Polyester-1, Maltodextrin, Sodium Chloride, Bisabolol, Disodium Lauriminodipropionate Tocopheryl Phosphates, Ethylhexylglycerin, Tremella Fuciformis Sporocarp Extract, Allantoin, Silica Dimethyl Silylate, Caprylyl Glycol, Isoceteth-10, Zein, Hexylene Glycol, Dimethylmethoxy Chromanol, Synthetic Fluorphlogopite, Zea Mays (Corn) Starch, Silica, Caesalpinia Spinosa Fruit Pod Extract, Hydrogenated Lecithin, Tetrasodium Glutamate Diacetate, Caprylic/​Capric Triglyceride, Helianthus Annuus (Sunflower) Sprout Extract, Phenoxyethanol, Sodium Benzoate, Benzoic Acid, Dehydroacetic Acid, Sodium Hydroxide, Sodium Myristoyl Glutamate, Aluminium Hydroxide, Titanium Dioxide (Ci 77891), Iron Oxides (Ci 77491, Ci 77492, Ci 77499)', 'dry', 2, '2025-06-08 08:06:37', '2025-06-18 21:42:38', 11),
(63, 'Complexion Rescue Tinted Moisturizer SPF 30', 'bareMinerals', 'Tinted Moisturizer', 'The #1 tinted moisturizer in the U.S*. This bareMinerals 3-in-1 COMPLEXION RESCUE multi-tasker is a moisturizer, skin tint and SPF 30, with Hyaluronic Acid to boost hydration for a dewy, healthy-looking glow. Perfect for dry and combo skin.', 670000.00, 'products/2vSGcd4GRQoPqj35YNtkZs5S8OqrFb63kAVE3h6u.png', 'Titanium Dioxide (6.2%) Inactive Ingredients: Water, Coconut Alkanes, Propanediol, Squalane, Trehalose, Isostearic Acid, Glycerin, Silica, Agar, Caprylic/​Capric Triglyceride, Globularia Cordifolia Callus Culture Extract, Salicornia Herbacea Extract, Melilotus Officinalis Extract, Coco-Caprylate/​Caprate, Butylene Glycol, Lauroyl Lysine, Sodium Hyaluronate, Succinoglycan, Polysorbate 60, Cellulose Gum, Polyglyceryl-4 Laurate/​Succinate, Sorbitan Sesquiisostearate, Magnesium Stearate, Magnesium Hydroxide, Magnesium Chloride, Potassium Chloride, Calcium Chloride, Potassium Sorbate, Phenoxyethanol, Hyaluronic Acid, Olive-Derived Squalane May Contain: Titanium Dioxide, Iron Oxides', 'dry', 2, '2025-06-08 08:07:36', '2025-06-18 21:42:23', 7),
(64, 'Eaze Drop Blurring Skin Tint', 'Fenty Beauty', 'Tinted Moisturizer', 'A blurring skin tint that delivers smooth, instantly blurred skin in just a few easy drops.', 525000.00, 'products/aKjYHzNZmO43NvMSshOfi8TLStr8qwkTkJhpuxzW.png', 'Aqua/​Water/​Eau, Dimethicone, Talc, Dicaprylyl Carbonate, Isostearyl Neopentanoate, PEG-10 Dimethicone, Dimethicone/​Vinyl Dimethicone Crosspolymer, Glycerin, Trimethylsiloxysilicate, Isododecane, Bis-PEG/​PPG-14/​14 Dimethicone, Phenoxyethanol, Sodium Chloride, Dimethicone Crosspolymer, Magnesium Sulfate, Hydrogen Dimethicone, Sodium Dehydroacetate, Trehalose, Urea, Potassium Sorbate, Silica, Disteardimonium Hectorite, Aluminum Hydroxide, Benzoic Acid, Sodium Hyaluronate, C24-28 Alkyl Methicone, Pentylene Glycol, Serine, Dehydroacetic Acid, Propylene Carbonate, Ethylhexylglycerin, Algin, Caprylyl Glycol, Disodium Phosphate, Glyceryl Polyacrylate, Pullulan, Tocopherol, Potassium Phosphate, Iron Oxides (Ci 77491, Ci 77492, Ci 77499), Titanium Dioxide (Ci 77891)', 'dry', 2, '2025-06-08 08:08:16', '2025-06-18 21:42:15', 6);
INSERT INTO `products` (`id`, `name`, `brand`, `category`, `description`, `price`, `image`, `ingredients`, `skin_type`, `seller_id`, `created_at`, `updated_at`, `stock`) VALUES
(65, 'Soft’lit Luminous Foundation', 'Fenty Beauty', 'Foundation', 'Delivering radiant, second-skin-like wear, the Fenty Beauty Soft\'Lit Naturally Luminous Longwear Foundation grants glowy medium coverage with a natural-looking finish.\r\nSweat and humidity-resistant, the unifying formula features a blend of cyperus papyrus leaf cell and kakadu plum extract to lend antioxidant defence, keeping your skin visibly bright and hydrated throughout the day. Non-oily, the foundation provides the perfect amount of luminosity that resists fading, oxidising and creasing to leverage your most radiant results yet.', 575000.00, 'products/oGvzvaLg3bvUpgjOtL1FHxOTeb1brS0sWkxFlv1w.webp', 'Aqua/Water/Eau, Dimethicone, Butylene Glycol Dicaprylate/Dicaprate, Diphenylsiloxy Phenyl Trimethicone, Glycerin, Synthetic Fluorphlogopite, Cetyl Peg/Ppg-10/1 Dimethicone, Trisiloxane, Butylene Glycol, 1,2-Hexanediol, Trimethylsiloxysilicate, Disteardimonium Hectorite, Peg-10 Dimethicone, Polyphenylsilsesquioxane, Magnesium Sulfate, Dimethicone Crosspolymer, Lauroyl Lysine, Triethoxycaprylylsilane, Aluminum Hydroxide, Polyhydroxystearic Acid, Ethylhexyl Palmitate, Isopropyl Myristate, Isostearic Acid, Lecithin, Terminalia Ferdinandiana Fruit Extract, Trisodium Ethylenediamine Disuccinate, Polyglyceryl-3 Polyricinoleate, Cyperus Rotundus Root Extract, Titanium Dioxide (Ci 77891), Iron Oxides (Ci 77491, Ci 77492, Ci 77499)', 'dry', 2, '2025-06-08 08:09:09', '2025-06-18 21:43:49', 1),
(66, 'Luminous Foundation', 'Anastasia Beverly Hills', 'Foundation', 'Anastasia Beverly Hills Luminous Foundation is a water-resistant liquid foundation that creates a luminous, natural finish. The radiant formula delivers long-wearing, medium coverage yet still feels weightless and looks ultra-fresh. This is the coverage you have been waiting for: Luminous Foundation looks so great on its own, there\'s no need to set with a powder. Available in 47 completely natural shades, this lightweight foundation blurs any imperfection - including discoloration and unevenness - without caking or masking the skin\'s natural radiance. With a seamless application, this easy-to-blend face makeup leaves the skin with a perfected-looking complexion that is free of flashback or oxidization.', 750000.00, 'products/hZf3RBALBRLfGsEInakMUFBurh0z0lBBGuosg3Fm.png', 'Water/​Aqua/​Eau, Cyclopentasiloxane, Isododecane, Caprylyl Methicone, C12-15 Alkyl Benzoate, Ethylhexyl Palmitate, Polyglyceryl-4 Isostearate, Hexyl Laurate, Cetyl PEG/​PPG-10/​1 Dimethicone, Glycerin, Trimethylsiloxysilicate, Butylene Glycol, Vinyl Dimethicone/​Methicone Silsesquioxane Crosspolymer, Sodium Chloride, Laminaria Ochroleuca Extract, Alanine, Arginine, Glycine, Isoleucine, Histidine, Phenylalanine, Proline, Threonine, Serine, Aspartic Acid, Valine, Sodium PCA, Panthenol, Tocopheryl Acetate, Allantoin, Sodium Lactate, Pca, Ethylhexylglycerin, Caprylic/​Capric Triglyceride, Simethicone, Tetrasodium EDTA, Triethoxycaprylylsilane, Zinc Stearate, Lauryl PEG-9 Polydimethylsiloxyethyl Dimethicone, Stearalkonium Hectorite, Propylene Carbonate, Phenoxyethanol May Contain: Chromium Oxide Greens (Ci 77288), Ultramarines (Ci 77007), Iron Oxides (Ci 77491, Ci 77492, Ci 77499), Titanium Dioxide (Ci 77891)', 'dry', 2, '2025-06-08 08:09:54', '2025-06-18 21:43:39', 10),
(67, 'Double Wear Stay In Place Makeup Foundation', 'Estee Lauder', 'Foundation', 'Wear confidence. Double Wear Makeup is the fresh matte foundation that looks flawless whatever comes your way. 24-hour wear. Oil-free. Controls oil all day. Sweat-, heat- and humidity-resistant. Lifeproof, waterproof foundation. 24-hour color true.Liquid foundation in a wide range of shades that flatters all. Won\'t look grey on deeper skintones. Unifies uneven  skintone and covers imperfections-buildable, medium to full coverage foundation.Feels lightweight and so comfortable, you won\'t believe it\'s long wear. No touch ups needed. Estee Lauder’s best foundation for long wear, Double Wear is the makeup that keeps up-no matter where your day takes you. Apply once and don\'t think twice.', 650000.00, 'products/lMog6IWiNTEtptVv5ElI5RQ2v68A1wKLDoy2XQ9m.png', 'Water\\Aqua\\Eau; Cyclopentasiloxane; Trimethylsiloxysilicate; Peg/Ppg-18/18 Dimethicone; Butylene Glycol; Tribehenin; Polyglyceryl-3 Diisostearate; Magnesium Sulfate; Tocopheryl Acetate; Polymethylsilsesquioxane; Methicone; Laureth-7; Xanthan Gum; Alumina; Sodium Dehydroacetate; Disteardimonium Hectorite; Cellulose Gum; Propylene Carbonate; Pentaerythrityl Tetra-Di-T-Butyl Hydroxyhydrocinnamate; Phenoxyethanol; [+/- Iron Oxides (Ci 77491, Ci 77492, Ci 77499); Mica; Titanium Dioxide (Ci 77891)] <ILN39010>', 'dry', 2, '2025-06-08 08:10:42', '2025-06-18 21:43:26', 2),
(69, 'Sunscreen: Rice + Probiotics', 'Beauty of Joseon', 'Sunscreen', 'Sunscreen : Rice + Probiotics diformulasikan dengan SPF 50+ PA++++ untuk memberikan perlindungan dari paparan sinar UV. Memiliki tekstur cream yang ringan dan tidak lengket, susncreen ini dapat menjadikan kulit tampak lembab dan sehat tanpa meninggalkan whitecast. Mengandung Rice Extract dan Grain Fermented Extracts yang kaya akan vitamin B, C, E, mineral, dan amino acid untuk melembabkan, menenangkan, serta menutrisi kulit secara bersamaan.\r\n\r\nDirekomendasikan untuk:\r\nSemua jenis kulit\r\n\r\nKey Ingredients:\r\n1. Rice Extract + Grain Fermented Extract\r\nMelembabkan dan mencerahkan kulit\r\n\r\n2. Ethylhexyl Triazone, Diethylamino Hydroxybenzoyl Hexyl Benzoate, Diethylhexyl Butamido Triazone, Methylene Bis-benzotriazolyl Tetramethylbutylphenol\r\nMelindungi kulit dari efek negatif sinar UVA dan UVB', 210000.00, 'products/jFjjmmOR5hhuueK7T34pZeJAn5wsWMIqQLoCnOHU.png', 'Aqua, Dibutyl Adipate, Propanediol, Diethylamino Hydroxybenzoyl Hexyl Benzoate, Polymethylsilsesquioxane\r\nEthylhexyl Triazone, Methylene Bis-Benzotriazolyl Tetramethylbutylphenol, Niacinamide, Coco-Caprylate/Caprate, Caprylyl Methicone, Diethylhexyl Butamido Triazone, 1,2-Hexanediol, Butylene Glycol, Glycerin, Pentylene Glycol, Behenyl Alcohol, Poly C10-30 Alkyl Acrylate, Polyglyceryl-3 Methylglucose Distearate, Decyl Glucoside, Oryza Sativa (Rice) Extract, Tromethamine, Carbomer, Acrylates/C10-30 Alkyl Acrylate Crosspolymer, Sodium Stearoyl Glutamate, Polyacrylate Crosspolymer-6, Ethylhexylglycerin, Adenosine, Glycerin, Xanthan Gum, Butylene Glycol, T-Butyl Alcohol, Tocopherol, Oryza Sativa Germ Extract, Oryza Sativa (Rice) Extract, Bacillus/Soybean Ferment Extract, Aspergillus Ferment, Macrocystis Pyrifera (Kelp) Extract, Cocos Nucifera (Coconut) Fruit Extract, Panax Ginseng Root Extract, Camellia Sinensis Leaf Extract, Saccharum Officinarum Extract, Monascus/Rice Ferment Filtrate, Lactobacillus/Rice Ferment, Saccharomyces/Rice Ferment Filtrate, Lactobacillus/Pumpkin Ferment Extract, Camellia Sinensis Leaf Extract', 'dry', 2, '2025-06-12 17:03:37', '2025-06-18 21:41:05', 20);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL COMMENT '1 to 5 stars',
  `review` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `address_detail` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `shipping` decimal(12,2) NOT NULL DEFAULT 9000.00,
  `total` decimal(12,2) NOT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `status` enum('pending','paid','cancelled','confirmed','shipped','success') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `shade` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('customer','admin','seller') NOT NULL DEFAULT 'customer',
  `fitzpatrick_type` varchar(255) DEFAULT NULL,
  `fitzpatrick_score` int(11) DEFAULT NULL,
  `baumann_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `fitzpatrick_type`, `fitzpatrick_score`, `baumann_type`) VALUES
(1, 'Admin Matchyaskin', 'admin@matchyaskin.com', NULL, '$2y$12$Dqv3M.iV6YFZ8365Mm6KOu0R7cm3kAcIjBmKEVfMvHGBzag5IPv1m', NULL, '2025-05-24 03:30:48', '2025-06-12 17:48:12', 'admin', NULL, NULL, ''),
(2, 'Seller Matchyaskin', 'seller@matchyaskin.com', NULL, '$2y$12$ZrZ4q4m5O4c1xMmNYVejhus9OeGB2NgGJjs3ETvj0z0fIAgCj2dgi', NULL, '2025-05-24 03:30:48', '2025-05-24 03:30:48', 'seller', NULL, NULL, ''),
(5, 'User Matchyaskin', 'user@matchyaskin.com', NULL, '$2y$12$wGYRgbkm8oQpL5gAMNy0ieDuMeF.7g2slYMu9wU0r0pY5pL/N.VoG', NULL, '2025-05-24 04:04:51', '2025-06-18 22:28:01', 'customer', 'Type 6', 35, 'OSPW'),
(14, 'test', 'test@test.com', NULL, '$2y$12$R8SX2w/uK8pCrNKpq1QZy.zgpgN9.i.f2ZQdaofawlGkwgC5gtmkW', NULL, '2025-06-08 04:14:57', '2025-06-08 04:23:29', 'customer', 'Type 5', 32, 'OSPW'),
(15, 'Intan M', 'lesmanaintanmeivita@gmail.com', NULL, '$2y$12$zhINaYcy/L4LQicFFNnWQuihBVO1yMpxq9938xl3bXGg9BNl8y7Va', NULL, '2025-06-08 08:47:33', '2025-06-08 10:53:38', 'customer', 'Type 4', 24, 'DRNT'),
(16, 'cindy', 'cindy_gunawan@gmail.com', NULL, '$2y$12$5G2kTFNHYoyfx1RU9pYry.DX/QumCaEJCIv/oT7lzsPWKAYicywL6', NULL, '2025-06-11 11:13:42', '2025-06-11 11:22:25', 'customer', 'Type 5', 33, 'OSPW'),
(17, 'Amelia Sutanto', 'amelia_sutanto99@gmail.com', NULL, '$2y$12$OjekO1ScI/YbWJtghixbW.z9GN49n7D27OXqF2IyLll0v1rkNvXSm', NULL, '2025-06-12 02:29:49', '2025-06-12 02:30:15', 'customer', NULL, NULL, NULL),
(19, 'Maya K.', 'mayakurniati_772@gmail.com', NULL, '$2y$12$b8nWRgqO1vItXKxy4JV7FuYCmpQU/lMxq.sJPQqCwwiTObMtnwmly', NULL, '2025-06-13 01:49:19', '2025-06-13 01:50:24', 'customer', NULL, NULL, NULL),
(20, 'Vivi', 'vgrracia01@gmail.com', NULL, '$2y$12$TKzqr1QwykcjlFrLrMVuyuGp/76kptB70IlZIqbGR65oOrxxMPKNS', NULL, '2025-06-15 04:09:45', '2025-06-15 04:09:45', 'customer', 'Type 3', 15, 'OSPW'),
(21, 'natasha', 'nat_angeline@gmail.com', NULL, '$2y$12$oHcJfW3qnn6pcpWYl8vkNOCGpdKyFL4UFO2vvV1kJlM8J.cYoEqqS', NULL, '2025-06-15 04:10:31', '2025-06-15 04:10:31', 'customer', 'Type 3', 17, 'DRPT'),
(22, 'janice', 'janiceprastyo2@gmail.com', NULL, '$2y$12$DGqAdTrQrT7Wh1tw0Ca3Q.tOLJ5MT9rtiAhZdt4Qpb8pKCIPUamTC', NULL, '2025-06-15 04:11:12', '2025-06-15 04:11:12', 'customer', NULL, NULL, NULL),
(23, 'andre', 'andreadraino7654@gmail.com', NULL, '$2y$12$SvlamIqb8uBPJxJv67b/vusmXazyQIPLovxP4eyWq4fDyKdpe1e02', NULL, '2025-06-15 04:11:53', '2025-06-15 04:11:53', 'customer', NULL, NULL, NULL),
(24, 'Nadya Listiany', 'nadlistiany99@gmail.com', NULL, '$2y$12$qRR/k7rRsTf/0cEG1jfyDuQn9e8GJ87/naoo9hNHaHxJKsMatJtUu', NULL, '2025-06-15 04:13:07', '2025-06-15 04:13:07', 'customer', 'Type 3', 18, 'OSPW'),
(25, 'siska', 'siskakurniawan79@gmail.com', NULL, '$2y$12$6pV2EEkZIuBbQopOtkze.eCfbrIQocFArIF8zgZO40N0Q41fKN8ZO', NULL, '2025-06-15 04:13:57', '2025-06-15 04:13:57', 'customer', NULL, NULL, NULL),
(26, 'Alaia', 'mealaia02@gmail.com', NULL, '$2y$12$S3KST/8oWNPvBPjkLAoUteBFajy1smwdFRQiqmKpCbf2B9VBYRL9e', NULL, '2025-06-15 04:14:32', '2025-06-15 04:14:32', 'customer', NULL, NULL, NULL),
(27, 'Monica', 'monicalaurensiaaa9@gmail.com', NULL, '$2y$12$iIUVgGa8QiAkK0HGJ8AqEOoi0Oes15PM.MZDCGVVokp9xLXFS9Rsi', NULL, '2025-06-15 04:15:21', '2025-06-15 04:15:21', 'customer', NULL, NULL, NULL),
(28, 'Aina', 'ainachu09@yahoo.com', NULL, '$2y$12$.yedT7j8DMzW25lC7BQdKONu4szjRNJ3eP/Rt.D8lTzCPCF6c3yxm', NULL, '2025-06-15 04:16:10', '2025-06-15 04:16:10', 'customer', 'Type 3', 16, 'DSPW'),
(29, 'Valensia', 'valz04@gmail.com', NULL, '$2y$12$nu.IW0QKEkH9FFxkol5pmuvAu0MZYGFX8/rKNQRjjWnH.k3xOkjL2', NULL, '2025-06-15 04:17:27', '2025-06-15 04:17:27', 'customer', NULL, NULL, NULL),
(30, 'Elena', 'elllenaaa888@gmail.com', NULL, '$2y$12$Rc/Uh7GqMbSbAazpTDD5L.utekTEIlWKPGJCKJrp/tUmVkZgbaF62', NULL, '2025-06-15 04:20:52', '2025-06-15 04:20:52', 'customer', 'Type 4', 22, 'DRPW'),
(31, 'Carolina', 'carolina_lim004@yahoo.com', NULL, '$2y$12$Y21hNXr1UU7047MmaG8x..eS5z5jn.GmaCKctCRrnRcB1uUMv/1XS', NULL, '2025-06-15 04:21:43', '2025-06-15 04:21:43', 'customer', NULL, NULL, NULL),
(32, 'carlita', 'carlitalimm00@yahoo.com', NULL, '$2y$12$mROvGGDEC9DOGqEDKrDpYObEMQLPADVqBJuT3R17/OmraunGBZ7We', NULL, '2025-06-15 04:22:37', '2025-06-15 04:22:37', 'customer', NULL, NULL, NULL),
(33, 'Felicia Lauren', 'felslau02@gmail.com', NULL, '$2y$12$nFz.NforbrxNKZzzsA5Lie.0nNBWC6z1z9ibEnG6jDV6GC0ZCu6aK', NULL, '2025-06-15 04:23:59', '2025-06-15 04:23:59', 'customer', 'Type 3', 18, 'ORNT'),
(34, 'Jessica', 'jess_wijayaa1@yahoo.com', NULL, '$2y$12$rzY2HMT3vUWaXHVR5PfrYOsj0QdRA6BL8hCA37ZQkgEwUcTKs4/vq', NULL, '2025-06-15 04:24:59', '2025-06-15 04:24:59', 'customer', NULL, NULL, NULL),
(35, 'crystal', 'crystalsantoso_03@gmail.com', NULL, '$2y$12$s.LUTvkkD/DkoZSx9z4pJ.uEXmciX56hNao/O0iDvp6AS74MkXXH6', NULL, '2025-06-15 04:26:54', '2025-06-15 04:26:54', 'customer', NULL, NULL, NULL),
(36, 'Kelly', 'kellyw_4567@gmail.com', NULL, '$2y$12$2Frf6aIYaFLwBMLh6cOJQOlAMhaKX2SQxglD0R.yMSeUp1TePBGcC', NULL, '2025-06-15 04:28:12', '2025-06-15 04:28:12', 'customer', 'Type 4', 24, 'OSPW'),
(37, 'Valerie', 'valpolaa01@gmail.com', NULL, '$2y$12$sJDAx3xHgo7ajS0QRBEM7eK1M6o7WSv/ceaR7t1w5z.Uf7V5fJ.dK', NULL, '2025-06-15 04:29:14', '2025-06-15 04:29:14', 'customer', NULL, NULL, NULL),
(38, 'Silvia', 'sil_fugahaa2@gmail.com', NULL, '$2y$12$cVqCfbwhLBcv4S/awDQa4O0rQRrSbAYwHItKWoUrVLrPGWeekhR1i', NULL, '2025-06-15 04:30:37', '2025-06-15 04:30:37', 'customer', NULL, NULL, NULL),
(39, 'silvia', 'silfugahaa88@gmail.com', NULL, '$2y$12$KpmnmLtqPUS/dVtfmCEcve/x7Ljt1Q.orzysEpavVVGBWygaN7gcW', NULL, '2025-06-15 04:31:51', '2025-06-15 04:31:51', 'customer', 'Type 3', 15, 'ORNT'),
(40, 'Sherren A', 'sherenangelitaa44@yahoo.com', NULL, '$2y$12$xn6h2hEqxSDMMhHUvhsKuezq5sVyV5q1IEWmGUeJAOo6zjzhD93/.', NULL, '2025-06-15 04:33:26', '2025-06-15 04:33:26', 'customer', NULL, NULL, NULL),
(41, 'Pratiwi S', 'pratiwiii_s98@gmail.com', NULL, '$2y$12$698JbHoO2/dOO94RYH5bue7UKVArhnPrX2iKI.klofd6t0LRRmaOq', NULL, '2025-06-15 04:34:41', '2025-06-15 04:34:41', 'customer', 'Type 3', 16, 'DRPW'),
(42, 'defi k', 'defiikurniatii_@yahoo.com', NULL, '$2y$12$.8r4xTkckHC5Woog8Hss2OnFSjqj8YcVlrvwDAKu7fbvcwFK16xUC', NULL, '2025-06-15 04:36:30', '2025-06-15 04:36:30', 'customer', NULL, NULL, NULL),
(43, 'Christin', 'christinjulitaa92@gmail.com', NULL, '$2y$12$4iFAQ7guPy7MIqar18cZ5ezP5XuUxYdEbZ4VvQjGdE2Yi/Hi5INUG', NULL, '2025-06-15 04:37:25', '2025-06-15 04:37:25', 'customer', NULL, NULL, NULL),
(44, 'paulina wijaya', 'paupau8812@yahoo.com', NULL, '$2y$12$bciUabjkpHgu9CIlHmsVh.fg2l40940R7cMOoxUMCY9IK04MNy8VC', NULL, '2025-06-15 04:41:32', '2025-06-15 04:41:32', 'customer', NULL, NULL, NULL),
(45, 'naomi', 'naomii_zz@gmail.com', NULL, '$2y$12$ZrsRG73Ny2S3h90pDN6R4evTB4ZrPzckkEvIbCyV9LQf0jmWHZV3m', NULL, '2025-06-15 04:42:12', '2025-06-15 04:42:12', 'customer', NULL, NULL, NULL),
(46, 'Ann', 'annaa002@gmail.com', NULL, '$2y$12$mWW/4VoOsZ1OXfbWoQf5Yu31wikRGTx/eAJljnuKdH9LR.haHocr2', NULL, '2025-06-15 04:42:52', '2025-06-15 04:42:52', 'customer', NULL, NULL, NULL),
(47, 'Novita Y', 'tanamalnovitayuki@yahoo.com', NULL, '$2y$12$5yLjk0rMpH89sX4cJt/p.uINhO2heIK6c9Y643HY03MBbykV0w7/y', NULL, '2025-06-15 04:43:51', '2025-06-15 04:43:51', 'customer', 'Type 3', 16, 'DRPT'),
(48, 'desi', 'desiindahs97@yahoo.com', NULL, '$2y$12$C5hkUP4Edqk4/ZKg.SL1AO6kbFYHsGUkijHo469/xIM9cerHdSiI.', NULL, '2025-06-15 04:44:44', '2025-06-15 04:44:44', 'customer', NULL, NULL, NULL),
(49, 'selvita b', 'selv_billiantii98@yahoo.com', NULL, '$2y$12$SSRVGXgrWYAuvcMV.vja/OZZBvG8vyi8OQmSUkol4bvcrw/J49nxO', NULL, '2025-06-15 04:45:39', '2025-06-15 04:45:39', 'customer', NULL, NULL, NULL),
(50, 'clara', 'clargrracia02@gmail.com', NULL, '$2y$12$3/RuDOENSx0dqlpl8hlZw.qv93NMzi81Z1s0LTkzlGpyrid5y7wn.', NULL, '2025-06-15 04:46:37', '2025-06-15 04:46:37', 'customer', 'Type 4', 24, 'ORNT'),
(51, 'Sarah', 'sarahmarantii2@yahoo.com', NULL, '$2y$12$6mLVwIL6AdouCxPsayvnD.WKr3y4S3zys8yvu7.fYWdw4eGjoK8kK', NULL, '2025-06-15 04:47:27', '2025-06-15 04:47:27', 'customer', NULL, NULL, NULL),
(52, 'canesia', 'mcanesiia00@gmail.com', NULL, '$2y$12$hisFBUgRzWvjsQYZozOuFeaxHsiWnIWC.ScvN9f1YBvzjH1Ihll4O', NULL, '2025-06-15 04:48:23', '2025-06-15 04:48:23', 'customer', NULL, NULL, NULL),
(53, 'sara', 'saralistianyy12@gmail.com', NULL, '$2y$12$v2iC3kO5t/xzLPc.r/iDJuVf3hkKwfBBErRfz7sw5uTYRU6t.D542', NULL, '2025-06-15 04:49:14', '2025-06-15 04:49:14', 'customer', NULL, NULL, NULL),
(54, 'kaemi', 'kaemizz04@gmail.com', NULL, '$2y$12$PjoUjZy2.beTWxd4LVFE..WAKfoMfuYPXeQtdd54iWlmqMmiHVdbG', NULL, '2025-06-15 04:50:29', '2025-06-15 04:50:29', 'customer', 'Type 2', 12, 'DRPW'),
(55, 'Lidya', 'lid_lidyaw56@gmail.com', NULL, '$2y$12$PwKaXTJbS2gX0vej968e4.wXiSMd20PKH91byhlvt4X.jT21f6BRC', NULL, '2025-06-15 04:52:02', '2025-06-15 04:52:02', 'customer', NULL, NULL, NULL),
(56, 'alaya', 'alayanaa33@gmail.com', NULL, '$2y$12$OSnQOVT1ctWN1i5g0UpJz.l5Nb8VTcZVO.HjoiYspyyEEx91RSOK.', NULL, '2025-06-15 04:52:49', '2025-06-15 04:52:49', 'customer', NULL, NULL, NULL),
(57, 'Cassie', 'wcassieee@icloud.com', NULL, '$2y$12$Y4DmEqHi6Pc5PY3F3IXVHuAd9i5o5ljyzy6maCjGhDBN167zmngNW', NULL, '2025-06-15 04:53:42', '2025-06-15 04:53:42', 'customer', NULL, NULL, NULL),
(58, 'jessica', 'jesjessiee17@icloud.com', NULL, '$2y$12$CymbX7UyKJtX5NRTdI3U/OtWtKVhbz/zCI8l1rMKGlWMmy1203kgC', NULL, '2025-06-15 04:55:36', '2025-06-15 04:55:36', 'customer', NULL, NULL, NULL),
(59, 'Yovita K', 'yovitakalyanii19@icloud.com', NULL, '$2y$12$v3xf2NdPPsP7iMXqyQ0bhupFyhgK1VvTv7HX3C2AKEz7f.L3MSt7S', NULL, '2025-06-15 04:57:58', '2025-06-15 04:57:58', 'customer', NULL, NULL, NULL),
(60, 'Sawani', 'sawaanii_99@gmail.com', NULL, '$2y$12$EWsd9Eg0YP9dDxX4hdBb7uQ4U1ZQM0/Q0swg..ycpfIcHJm6YToIy', NULL, '2025-06-15 04:59:15', '2025-06-15 04:59:15', 'customer', NULL, NULL, NULL),
(61, 'tazia', 'tazz01@gmail.com', NULL, '$2y$12$Vs0zdik4WzahHtvNoZrlwuSUiOsWB1IDBzXS5vAZGTWbbRGH97VbS', NULL, '2025-06-15 05:12:22', '2025-06-15 05:12:22', 'customer', NULL, NULL, NULL),
(62, 'Celine', 'cellineew6@icloud.com', NULL, '$2y$12$bGwtLmsARG0/7EQpgQ79S./23YTp5DKav4zzjcXlztU/y7xzODQU.', NULL, '2025-06-15 05:13:21', '2025-06-15 05:13:21', 'customer', NULL, NULL, NULL),
(63, 'aina yamazaki', 'ainaa_yamazaki00@hotmail.com', NULL, '$2y$12$3kk6TRVoEDxAvMBPz8L.reZN9GriM8Y0Jzb5qsNblbFtxSgueOJwK', NULL, '2025-06-15 05:14:09', '2025-06-15 05:14:09', 'customer', NULL, NULL, NULL),
(64, 'tasya', 'tasyaafar67@gmail.com', NULL, '$2y$12$KRPkaue.VpH9gY8HnZa.l.q5LPsY4xyqjPZEwG8INoG1Dzg4ytitK', NULL, '2025-06-15 05:15:00', '2025-06-15 05:15:00', 'customer', NULL, NULL, NULL),
(65, 'kezya', 'kezyaawijayya_44@gmail.com', NULL, '$2y$12$1dowYiz5ms79li1JKNDvwuBBlRc.FBC1PQtoysiP0h1eOC/1Yaypi', NULL, '2025-06-15 05:16:01', '2025-06-15 05:16:01', 'customer', NULL, NULL, NULL),
(66, 'maria kosasih', 'mar_kosasihh97@gmail.com', NULL, '$2y$12$xTDL9ldNtR3pI3xBh8P9c.5lbosU3dR1xhH8WgI0r.99pfVrmGdJ6', NULL, '2025-06-15 05:17:00', '2025-06-15 05:17:00', 'customer', NULL, NULL, NULL),
(67, 'Caca M', 'ccmeriskaaaaa@gmail.com', NULL, '$2y$12$FcmeFCHKxxEd9VEsRnZQFO4teNEDUqXx44DIvAb1ujRx4GdfLT/Pu', NULL, '2025-06-15 05:18:22', '2025-06-15 05:18:22', 'customer', 'Type 3', 16, 'ORNT'),
(68, 'Idriana', 'idrianatalliew@gmail.com', NULL, '$2y$12$B1OKymbVJI2bru3TMsVC8Od/wGhyTzZi6zFJPYWPxCsKMWWMYmjKW', NULL, '2025-06-15 05:19:35', '2025-06-15 05:19:35', 'customer', NULL, NULL, NULL),
(69, 'lili', 'liliiee5678@gmail.com', NULL, '$2y$12$O7S/IpA98YOZjtg0xUvy8uAL2LBoinfto1H4yxsBLETS5Z/kvHhmG', NULL, '2025-06-15 05:20:22', '2025-06-15 05:20:22', 'customer', NULL, NULL, NULL),
(70, 'Angel Nathania', 'nathananiaa_angell@gmail.com', NULL, '$2y$12$Eh8cbJ6gLBcrE0TkXtjYeOgLmwvIyQHOxTwe4Egvw1pc5ei/MhTmq', NULL, '2025-06-15 05:21:37', '2025-06-15 05:21:37', 'customer', NULL, NULL, NULL),
(71, 'Felicia p', 'feliciaaphang99@yahoo.com', NULL, '$2y$12$oRnCPhkzMNGrg9oST0SFaO0Evt0ysG01J34jN1pJsF/jrsW/02wsC', NULL, '2025-06-15 05:22:40', '2025-06-15 05:22:40', 'customer', 'Type 3', 15, 'DSPW'),
(72, 'felicia angelina', 'felii_fa@icloud.com', NULL, '$2y$12$NgSKw84bSZNCANUw4EFn2O6U2wpypgAe/108imRzcI2lZPYrMj5TK', NULL, '2025-06-15 05:24:03', '2025-06-15 05:24:03', 'customer', NULL, NULL, NULL),
(73, 'stevina j', 'steviicaa99@gmail.com', NULL, '$2y$12$Whp8W8s675thtn9qL69wEuV.qyTNRuDIf7zB6lF6ZoktwPFN7wFYC', NULL, '2025-06-15 05:25:30', '2025-06-15 05:25:30', 'customer', NULL, NULL, NULL),
(74, 'tiffany', 'tiffhotamaa@icloud.com', NULL, '$2y$12$mbJLLcdGStRAuwRj7xSQnO0qkQGDaaCEcnEXL2tTkkf1SVJDx0a72', NULL, '2025-06-15 05:26:12', '2025-06-15 05:26:12', 'customer', NULL, NULL, NULL),
(75, 'Veronika D', 'depongg00@gmail.com', NULL, '$2y$12$LzVBWjTra7mlRLzhEdLbHOLhoYNImLsosByH2I1tf0wuYn.XjTqY.', NULL, '2025-06-15 05:27:15', '2025-06-15 05:27:15', 'customer', NULL, NULL, NULL),
(76, 'tiffany', 'tiipugneyy@gmail.com', NULL, '$2y$12$VKajcb/wxHYdxieUPzLn6OP2V4ZBAzw2AlvFpWaA30gapceqqmYla', NULL, '2025-06-15 05:28:01', '2025-06-15 05:28:01', 'customer', NULL, NULL, NULL),
(77, 'edward', 'edwardssurajaya_00@gmail.com', NULL, '$2y$12$aFSKXdX5mdA2jYIhOTq8s.F1DiPPxCbs0x2PkClOWAXrM50wUccqO', NULL, '2025-06-15 05:29:27', '2025-06-15 05:29:27', 'customer', NULL, NULL, NULL),
(78, 'kezz', 'kezzi_aaie@yahoo.com', NULL, '$2y$12$ggPxSXMbTP9XGT8qy8TjW.eX9GH1ojZJC/fehcQHWSgvWiRSAzo76', NULL, '2025-06-15 05:30:18', '2025-06-15 05:30:18', 'customer', NULL, NULL, NULL),
(79, 'melody', 'cahyamelodyy@icloud.com', NULL, '$2y$12$BGzyoNemZTQABD6RgQoDReYKojJ5uamXe41a9foJU.0W4l1a83NFO', NULL, '2025-06-15 05:31:00', '2025-06-15 05:31:00', 'customer', NULL, NULL, NULL),
(80, 'khanti', 'khantimuditaa@gmail.com', NULL, '$2y$12$a6OfOqbPRFIfEJO32KhFj.u2Q9mM.lfDgXf4MuCgu1Gkh0rk.0xPW', NULL, '2025-06-15 05:31:34', '2025-06-15 05:31:34', 'customer', NULL, NULL, NULL),
(81, 'Metta', 'mettakalyanii03@gmail.com', NULL, '$2y$12$GmfgbWmsd49xpI5qxNEZZuxAIBmyc58GRngcnHxkfCjn9lSHu8bpq', NULL, '2025-06-15 05:32:24', '2025-06-15 05:32:24', 'customer', 'Type 2', 11, 'DRPW'),
(82, 'Candima R', 'candimarangsii98@gmail.com', NULL, '$2y$12$I9lTOFtsvZ7zPaayV9OSwO.HnpzTrksE.0Z5zemIn69rzwJJHlPZO', NULL, '2025-06-15 05:34:04', '2025-06-15 05:34:04', 'customer', NULL, NULL, NULL),
(83, 'Valensia', 'valss_99@icloud.com', NULL, '$2y$12$F7RisvOqVt.aNoGlqHRTqOvgv.jXgUJ58ZP7zX6sY4EmSagX9ch.e', NULL, '2025-06-15 05:34:49', '2025-06-15 05:34:49', 'customer', NULL, NULL, NULL),
(84, 'Nathalie', 'nathalieeana_8989@gmail.com', NULL, '$2y$12$2VN.RYCzGbUnp3FNOeGZn.neiSnhhWFa.3MtcSrDJu9ZDKx78PYqG', NULL, '2025-06-15 05:35:48', '2025-06-15 05:35:48', 'customer', NULL, NULL, NULL),
(85, 'mellysia', 'mell_ysiaa@gmail.com', NULL, '$2y$12$2uD1fab.hHvjKt1iil7kFuMBbmYpmDnwdoPk6iT35SzDtHEEd0naW', NULL, '2025-06-15 05:36:43', '2025-06-15 05:36:43', 'customer', NULL, NULL, NULL),
(86, 'putri m', 'mputrrii4563@gmail.com', NULL, '$2y$12$Krd7SdwhdkY9PXVTibVv9./UwG1TZIQFyxznoAfsVWjXg8wiYJ9fe', NULL, '2025-06-15 05:37:37', '2025-06-15 05:37:37', 'customer', NULL, NULL, NULL),
(87, 'meggie', 'meggiee22@icloud.com', NULL, '$2y$12$gpehfLcA..O5mirTZ/16A.CCteiwuR5rQqcMin.ob2Cb0j5nS6gs6', NULL, '2025-06-15 05:38:43', '2025-06-15 05:38:43', 'customer', NULL, NULL, NULL),
(88, 'verischa', 'verrischaa11@gmail.com', NULL, '$2y$12$7TqmNo75hJY5rBvM.E.69.tgt0YjkmU31VJ.VsVc7SjRE3cxFfvni', NULL, '2025-06-15 05:39:30', '2025-06-15 05:39:30', 'customer', NULL, NULL, NULL),
(89, 'tiara', 'tiaraaxyzz00@gmail.com', NULL, '$2y$12$FWuj3S3OSeBn84.DZY9X2uEBYOyMmiqE9MHMDPTwWW7dVlHA0GnyO', NULL, '2025-06-15 05:40:20', '2025-06-15 05:40:20', 'customer', NULL, NULL, NULL),
(90, 'Mikha', 'mikhaaq343@gmail.com', NULL, '$2y$12$OOrrF0JhHjXzRgW3NDUuM.j2ZdvLa6OzGpQFj11Sbna7jIt5474c.', NULL, '2025-06-15 05:41:10', '2025-06-15 05:41:10', 'customer', NULL, NULL, NULL),
(91, 'Sophie', 'lilianaasophi3@icloud.com', NULL, '$2y$12$V72dxsnO4ZR47H4b6VpP5uVcxzXH2mYxZeiuenAkRmI5l9vwDWomG', NULL, '2025-06-15 05:42:07', '2025-06-15 05:42:07', 'customer', NULL, NULL, NULL),
(92, 'hanna', 'mhannassz01@gmail.com', NULL, '$2y$12$L.dwvl3vIrSQxOjTmgFm4eqYZW6cz8snUPRvxpxCRNqzDMzq75xT6', NULL, '2025-06-15 05:42:44', '2025-06-15 05:42:44', 'customer', NULL, NULL, NULL),
(93, 'melanie', 'melann05ie@gmail.com', NULL, '$2y$12$4Vn9u.6j.QuUKa9AOOCTkuAJwP4Nyuyiz7fMASDpeweBUUmg7MO22', NULL, '2025-06-15 05:43:27', '2025-06-15 05:43:27', 'customer', 'Type 3', 15, 'DSPT'),
(94, 'Monica', 'mmo01nie@gmail.com', NULL, '$2y$12$1gesQGUBHWcrP8OSb8cmTek6ZKYaZe52YCdIWIWO0ngjlwkxYLhmK', NULL, '2025-06-15 05:44:17', '2025-06-15 05:44:17', 'customer', 'Type 3', 18, 'DRNT'),
(95, 'puhtaytow', 'puhtaytow22@gmail.com', NULL, '$2y$12$7UsbEkXvFDgaYwYQ3z.nhurxr4Uf09iWxWFnL1b.Cv7YbTLXSmxP6', NULL, '2025-06-18 00:59:44', '2025-06-18 00:59:44', 'customer', NULL, NULL, NULL),
(96, 'Evangeline Aldrich', 'evan_epen0017@gmail.com', NULL, '$2y$12$CQZhxAT6E5KFpsiCTSLfyOyuDAnAhk8e8lxCQKqbjJ4fw9Sc0dooC', NULL, '2025-06-18 01:00:23', '2025-06-18 01:00:23', 'customer', NULL, NULL, NULL),
(97, 'Geraldo', 'gerharn31_1@gmail.com', NULL, '$2y$12$V3iYnSy1Ao.dKvDLdAOp7OUvQkmM36QI8lSpIfybFlt6X.cSKBBIG', NULL, '2025-06-18 01:01:00', '2025-06-18 01:01:00', 'customer', NULL, NULL, NULL),
(98, 'Adeline Liminto', 'deliline1120@gmail.com', NULL, '$2y$12$Ym1X1sD9mxols.EJsVPKuu3e9TGrc.sAQfDwoQM3vaQF0MbuQm0B2', NULL, '2025-06-18 01:01:35', '2025-06-18 01:01:35', 'customer', NULL, NULL, NULL),
(99, 'mu.h000', 'mulan_mull@gmail.com', NULL, '$2y$12$oxAVNzTMtX0hX.TI98YRjuLvzv6T1jvf2qHgRnKiyNLd/DKT.eDd6', NULL, '2025-06-18 01:02:21', '2025-06-18 01:02:21', 'customer', NULL, NULL, NULL),
(100, 'Darlene Nathania', 'darlenenath55@gmail.com', NULL, '$2y$12$BwMYBLETTkcN6gXkWLM9Mux7ORusEZQEb2AoBb6xXidZlg1hDtAZy', NULL, '2025-06-18 01:02:56', '2025-06-18 01:02:56', 'customer', 'Type 4', 22, 'ORNT'),
(101, 'Candima Rangsi', 'candima_k4liani@gmail.com', NULL, '$2y$12$73curP0iM84DY/Ouex/OXe2YWe.FXc1laW/7XuD9/0ixGcpO0L7iy', NULL, '2025-06-18 01:03:26', '2025-06-18 01:03:26', 'customer', NULL, NULL, NULL),
(102, 'Clara Immanuela', 'clara_immanuel11@gmail.com', NULL, '$2y$12$2L.l/GjvvjGOGs1jLM1xx.Pp0pMCBdwlZWcEabFd9NRxtcU3Pr76C', NULL, '2025-06-18 01:03:50', '2025-06-18 01:03:50', 'customer', NULL, NULL, NULL),
(103, 'canesiaaaaaa', 'canesiatimotius99@gmail.com', NULL, '$2y$12$B/rsqADJOdHCFdpc.9xoLOendCrjMrOwIdtEzSq5eEJE33am/kCyW', NULL, '2025-06-18 01:04:23', '2025-06-18 01:04:23', 'customer', NULL, NULL, NULL),
(104, 'Lamtiur Ruth', 'lamlam_tiurma@gmail.com', NULL, '$2y$12$ug2YX.i1O/GkltamranHE.kxcpw1AA8mSNBZfOQJv425jwe8rKVAu', NULL, '2025-06-18 01:05:20', '2025-06-18 01:05:20', 'customer', NULL, NULL, NULL),
(105, 'janice angela', 'imjanice992@gmail.com', NULL, '$2y$12$tmKGupoN4JOqA6oQwIY1tu95ufjFnEyw9mmODOf7twHWbs3gDZYmm', NULL, '2025-06-18 01:05:49', '2025-06-18 01:05:49', 'customer', NULL, NULL, NULL),
(106, 'Cindy', 'cindyceline098@gmail.com', NULL, '$2y$12$nHNf3e0YbfHTZgdjSxVXQ.jtilFAak9K3Be.OXiI3EQJnOMRfV/0C', NULL, '2025-06-18 01:06:23', '2025-06-18 01:06:23', 'customer', NULL, NULL, NULL),
(107, 'Angelica Sadrach', 'angel_sad22@gmail.com', NULL, '$2y$12$/Z73eiN4OouP1my5U9OlWOx/csdJjciU0vJSIANeBne9303WyT9A2', NULL, '2025-06-18 01:07:29', '2025-06-18 01:07:29', 'customer', 'Type 3', 18, 'ORNT'),
(108, 'Tiffany Anabel', 'tiffanabel888@gmail.com', NULL, '$2y$12$6Tkq7f8mqVdUSigcJGnuuO2J39Z.6IhJ0hN21Cebo.ihC6iOhjQcW', NULL, '2025-06-18 01:07:59', '2025-06-18 01:07:59', 'customer', NULL, NULL, NULL),
(109, 'Ferdinand Sunarja', 'ferdinandsunarja23@gmail.com', NULL, '$2y$12$O/bbVltsiIAgsQtGAlxVK./dZU7dtE23kFRui9CsBmsPhj5pwsRUm', NULL, '2025-06-18 01:08:43', '2025-06-18 01:08:43', 'customer', NULL, NULL, NULL),
(110, 'Aurellia velda', 'aurelliavelalf_12@gmail.com', NULL, '$2y$12$dXA59O8UzsQ1glol.bxclOAv.1a04AzLxIOv9NApZOfkQ3O6VgUHi', NULL, '2025-06-18 01:09:30', '2025-06-18 01:09:30', 'seller', NULL, NULL, NULL),
(111, 'Nethanya Grace', 'anya.grace99@gmail.com', NULL, '$2y$12$6GSEGOY4RHXx1wwWuim7keVTOT6HVUNQ4t/f6z9ZBg6XvILkTMveS', NULL, '2025-06-18 01:10:00', '2025-06-18 01:10:00', 'customer', NULL, NULL, NULL),
(112, 'Aura Nixie', 'aura_nixx7@gmail.com', NULL, '$2y$12$MZMGghB5RtJ1DRdXEyo7W.llOwDoE2j7nxYGK9GQQAxt0vkE3Rg8W', NULL, '2025-06-18 01:10:39', '2025-06-18 01:10:39', 'customer', NULL, NULL, NULL),
(113, 'Amelia', 'ameliaahoskyy@gmail.com', NULL, '$2y$12$gJPx.unR1RubzVB5fhzEx.KbL1zoKPIIzIQc7aDxVRc9UK0FKIsey', NULL, '2025-06-18 01:11:04', '2025-06-18 01:11:04', 'customer', 'Type 3', 17, 'DSNT'),
(114, 'Amelia Callista', 'ameliacllista2002@gmail.com', NULL, '$2y$12$moQ83.bJrCmif8.1yu18i.11T8iQFh//os0g7rdIhhQ0PCKFXezQW', NULL, '2025-06-18 01:11:38', '2025-06-18 01:11:38', 'customer', NULL, NULL, NULL),
(115, 'Fora Bong', 'fora_amy95@gmail.com', NULL, '$2y$12$DFWwtqiqWuZvMrIULy7x/ujUP9caZW1WDCh/jxzmkmxvq7eP.NaFW', NULL, '2025-06-18 01:12:07', '2025-06-18 01:12:07', 'customer', NULL, NULL, NULL),
(116, 'Hasna Amellia', 'hasnacook22@gmail.com', NULL, '$2y$12$cdwCXRaMT3BQn5kBQWB/Su8y.RGMP6u65siCR.g8xPq826tyvlBju', NULL, '2025-06-18 01:12:44', '2025-06-18 01:12:44', 'customer', 'Type 4', 22, 'OSNT'),
(117, 'Ayumi', 'ayumi.th88@gmail.com', NULL, '$2y$12$Sl6SLyp20YjCujebdOtgyOQKPhkcDwNmvhszaDjRwIeAHODwG.4Lu', NULL, '2025-06-18 01:13:13', '2025-06-18 01:13:13', 'customer', NULL, NULL, NULL),
(118, 'tazkia', 'tazkiaramadhan99@gmail.com', NULL, '$2y$12$Pbluu1X4faQDMkEqBb7PvevJ.ryl7APTAUGSNJQcKW6xDugPbUdKK', NULL, '2025-06-18 01:13:47', '2025-06-18 01:13:47', 'customer', 'Type 3', 17, 'DRPT'),
(119, 'Amanda GRACIA', 'grace.amanda1109@gmail.com', NULL, '$2y$12$CrP7iLtXjGECem9Id.bqceFK/VNyyxV/b.fmsOWc7u4/JlCRmFh3a', NULL, '2025-06-18 01:14:24', '2025-06-18 01:14:24', 'customer', NULL, NULL, NULL),
(120, 'Liviaaaa', 'liviaa_aaaa@gmail.com', NULL, '$2y$12$IqJFQXUKM79b8GfsMoVx5.r1H2aFTLWB5I9ej8gEamR/uwWVbxX6y', NULL, '2025-06-18 01:14:50', '2025-06-18 01:14:50', 'customer', NULL, NULL, NULL),
(121, 'Genoveva Audrey', 'genoveva_anabella@gmail.com', NULL, '$2y$12$ypOvXL0uCZ2tVsAWcR8gYuJBk8/5mX6dznGGW3KJCOKP/ilbssDWG', NULL, '2025-06-18 01:15:27', '2025-06-18 01:15:27', 'customer', NULL, NULL, NULL),
(122, 'Jovinka gatha', 'jovinka_agatha@gmail.com', NULL, '$2y$12$QpULEDo0kqS8YW0tgB.VFuWh0DN9J0.N1C08UXe5jL2AtKWlfIKMq', NULL, '2025-06-18 01:15:57', '2025-06-18 01:15:57', 'customer', 'Type 3', 17, 'DRNT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ingredients_name_unique` (`name`);

--
-- Indexes for table `ingredient_product`
--
ALTER TABLE `ingredient_product`
  ADD PRIMARY KEY (`product_id`,`ingredient_id`),
  ADD KEY `ingredient_product_ingredient_id_foreign` (`ingredient_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_seller_id_foreign` (`seller_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_items_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
