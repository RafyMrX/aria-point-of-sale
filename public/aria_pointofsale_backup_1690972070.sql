

CREATE TABLE `categories` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_category` char(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO categories VALUES("27","K0001","Makanan","2023-07-22 01:06:09","2023-07-22 01:06:09");
INSERT INTO categories VALUES("28","K0002","Gorengan","2023-07-22 01:06:18","2023-07-22 01:06:18");
INSERT INTO categories VALUES("29","K0003","Roti","2023-07-22 01:06:25","2023-07-22 01:06:25");
INSERT INTO categories VALUES("30","K0004","Kue","2023-07-22 01:06:43","2023-07-22 01:06:43");
INSERT INTO categories VALUES("31","K0005","Cemilan","2023-07-22 01:07:00","2023-07-22 01:07:00");
INSERT INTO categories VALUES("32","K0006","Minuman","2023-07-22 01:07:57","2023-07-22 01:07:57");
INSERT INTO categories VALUES("33","K0007","Buah","2023-07-22 07:48:36","2023-07-22 07:48:45");
INSERT INTO categories VALUES("34","K0008","Nasi","2023-07-22 07:58:53","2023-07-22 07:58:53");



CREATE TABLE `detail_pur` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_pur` text NOT NULL,
  `id_product` char(6) NOT NULL,
  `id_supplier` char(6) NOT NULL,
  `id_user` char(5) NOT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `qty` int(10) unsigned NOT NULL,
  `qty_retur` int(11) unsigned DEFAULT 0,
  `capital_price` int(10) unsigned NOT NULL,
  `selling_price` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO detail_pur VALUES("2","INV/B/23072023/0001","008","SP0001","A0001","mika","40","0","6000","7000","2023-07-23 19:57:39","2023-07-23 19:57:39");
INSERT INTO detail_pur VALUES("3","INV/B/23072023/0002","024","SP0002","A0001","pcs","80","0","2000","3000","2023-07-23 20:01:17","2023-07-23 20:01:17");
INSERT INTO detail_pur VALUES("5","INV/B/23072023/0003","026","SP0002","A0001","pcs","40","0","2000","3000","2023-07-23 20:03:12","2023-07-23 20:03:12");
INSERT INTO detail_pur VALUES("6","INV/B/23072023/0004","027","SP0003","A0001","pcs","50","0","1750","3000","2023-07-23 20:04:41","2023-07-23 20:04:41");
INSERT INTO detail_pur VALUES("7","INV/B/23072023/0005","014","SP0004","A0001","pcs","80","0","2000","3500","2023-07-23 20:06:06","2023-07-23 20:06:06");
INSERT INTO detail_pur VALUES("9","INV/B/23072023/0007","036","SP0006","A0001","bungkus","50","0","8000","9000","2023-07-23 20:09:45","2023-07-23 20:09:45");
INSERT INTO detail_pur VALUES("10","INV/B/23072023/0008","044","SP0007","A0001","bungkus","20","0","8000","9000","2023-07-23 20:12:43","2023-07-23 20:12:43");
INSERT INTO detail_pur VALUES("11","INV/B/23072023/0009","009","SP0008","A0001","pcs","40","0","2000","6000","2023-07-23 20:24:14","2023-07-23 20:24:14");
INSERT INTO detail_pur VALUES("14","INV/B/26072023/0010","006","SP0004","A0001","pcs","10","0","1300","2000","2023-07-26 19:58:44","2023-07-26 19:58:44");
INSERT INTO detail_pur VALUES("15","INV/B/26072023/0010","007","SP0004","A0001","pcs","10","0","1300","2000","2023-07-26 19:58:44","2023-07-26 19:58:44");
INSERT INTO detail_pur VALUES("18","INV/B/20230805/0011","007","SP0001","A0001","pcs","1","0","1300","2000","2023-08-02 16:12:47","2023-08-02 16:12:47");
INSERT INTO detail_pur VALUES("19","INV/B/20230805/0012","008","SP0004","A0001","mika","2","0","6000","7000","2023-08-02 16:16:17","2023-08-02 16:16:17");
INSERT INTO detail_pur VALUES("20","INV/B/20230801/0013","009","SP0002","A0001","pcs","1","0","2000","3000","2023-08-02 16:16:57","2023-08-02 16:16:57");



CREATE TABLE `detail_sales` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_sale` text NOT NULL,
  `id_product` char(6) NOT NULL,
  `id_retail` char(6) NOT NULL,
  `id_user` char(5) NOT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `qty` int(10) unsigned NOT NULL,
  `qty_retur` int(11) unsigned DEFAULT 0,
  `capital_price` int(10) unsigned NOT NULL,
  `selling_price` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO detail_sales VALUES("69","INV/J/20230802/0001","007","RT0001","A0001","pcs","1","0","1300","2000","2023-08-02 11:52:51","2023-08-02 11:52:51");
INSERT INTO detail_sales VALUES("70","INV/J/20230802/0002","007","RT0001","A0001","pcs","1","0","1300","2000","2023-08-02 11:53:10","2023-08-02 11:53:10");
INSERT INTO detail_sales VALUES("71","INV/J/20230802/0003","007","RT0001","A0001","pcs","1","0","1300","2000","2023-08-02 11:53:31","2023-08-02 11:53:31");
INSERT INTO detail_sales VALUES("72","INV/J/20230801/0004","007","RT0001","A0001","pcs","1","0","1300","2000","2023-08-02 11:53:53","2023-08-02 11:53:53");
INSERT INTO detail_sales VALUES("73","INV/J/20230728/0005","007","RT0001","A0001","pcs","1","0","1300","2000","2023-08-02 15:47:23","2023-08-02 15:47:23");
INSERT INTO detail_sales VALUES("74","INV/J/20230707/0006","007","RT0001","A0001","pcs","1","0","1300","2000","2023-08-02 15:48:59","2023-08-02 15:48:59");
INSERT INTO detail_sales VALUES("75","INV/J/20230701/0007","006","RT0001","A0001","pcs","1","0","1300","2000","2023-08-02 15:49:20","2023-08-02 15:49:20");



CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("5","2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("6","2014_10_12_100000_create_password_resets_table","1");
INSERT INTO migrations VALUES("7","2019_08_19_000000_create_failed_jobs_table","1");
INSERT INTO migrations VALUES("8","2019_12_14_000001_create_personal_access_tokens_table","1");



CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `products` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_product` char(6) NOT NULL,
  `id_category` char(6) DEFAULT NULL,
  `barcode` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `capital_price` int(10) unsigned DEFAULT NULL,
  `selling_price` int(10) unsigned DEFAULT NULL,
  `unit` varchar(200) DEFAULT NULL,
  `qty` int(10) unsigned DEFAULT NULL,
  `exp` date DEFAULT NULL,
  `status` enum('1','2') NOT NULL,
  `produksi` enum('1','2') NOT NULL,
  `retur` enum('1','2') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_product` (`id_product`),
  KEY `fk_category` (`id_category`),
  CONSTRAINT `fk_category` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO products VALUES("1","001","K0003","DNT","Donat","1800","4000","pcs","270","","1","1","2","2023-07-22 01:56:01","2023-07-26 14:09:46");
INSERT INTO products VALUES("2","002","K0003","DNTK","Donat Kecil","1000","3000","pcs","100","","1","1","2","2023-07-22 01:58:07","2023-07-23 12:51:15");
INSERT INTO products VALUES("3","003","K0004","PT","Putuayu","1000","2500","pcs","11","","1","1","2","2023-07-22 02:01:18","2023-08-02 02:10:30");
INSERT INTO products VALUES("4","004","K0003","KS","Kukus","1000","3000","pcs","84","","1","1","2","2023-07-22 02:04:20","2023-08-02 02:10:30");
INSERT INTO products VALUES("5","005","K0003","KSK","Kukus Kecil","1000","2000","pcs","1000","","1","1","2","2023-07-22 02:05:50","2023-07-23 12:51:22");
INSERT INTO products VALUES("6","006","K0002","PHG","Pohong Goreng","1300","2000","pcs","9","","1","2","2","2023-07-22 02:13:22","2023-08-02 15:49:20");
INSERT INTO products VALUES("7","007","K0002","PHK","Pohong Kukus","1300","2000","pcs","5","","1","2","2","2023-07-22 02:15:31","2023-08-02 16:12:47");
INSERT INTO products VALUES("8","008","K0002","LM","Lumpia Mika","6000","7000","mika","36","","1","2","1","2023-07-22 02:17:52","2023-08-02 16:16:17");
INSERT INTO products VALUES("9","009","K0002","LB","Lumpia Biji","2000","3000","pcs","47","","1","2","1","2023-07-22 02:28:36","2023-08-02 16:16:57");
INSERT INTO products VALUES("10","010","K0002","LBSH","Lumpia Basah","5000","6000","pcs","0","","1","2","1","2023-07-22 02:29:50","2023-07-26 07:23:30");
INSERT INTO products VALUES("11","011","K0002","RMY","Risol Mayo","2500","3000","pcs","0","","1","2","1","2023-07-22 02:31:11","2023-07-26 07:23:59");
INSERT INTO products VALUES("12","012","K0002","RGT","Risol Rougut","2500","3000","pcs","0","","1","2","2","2023-07-22 02:32:22","2023-07-22 02:32:22");
INSERT INTO products VALUES("13","013","K0002","SLO","Sosis Solo","2000","3000","pcs","0","","1","2","2","2023-07-22 02:40:54","2023-07-23 03:24:16");
INSERT INTO products VALUES("14","014","K0004","LMP","Lemper","2000","3500","pcs","62","","1","2","2","2023-07-22 02:42:50","2023-08-02 02:10:30");
INSERT INTO products VALUES("15","015","K0004","LMPB","Lemper Bakar","2000","3500","pcs","0","","1","2","2","2023-07-22 02:44:10","2023-07-22 07:57:56");
INSERT INTO products VALUES("16","016","K0004","PBW","Pai Brownis","3500","4000","pcs","0","","1","2","2","2023-07-22 02:49:01","2023-07-22 02:49:01");
INSERT INTO products VALUES("17","017","K0004","PBH","Pai Buah","3500","4000","pcs","0","","1","2","2","2023-07-22 02:50:11","2023-07-22 02:50:11");
INSERT INTO products VALUES("18","018","K0004","PSU","Pai Susu","3500","4000","pcs","0","","1","2","2","2023-07-22 06:05:13","2023-07-22 06:05:13");
INSERT INTO products VALUES("19","019","K0004","DRGL","Dadar Gulung","1300","2500","pcs","0","","1","2","2","2023-07-22 06:07:35","2023-07-22 06:10:14");
INSERT INTO products VALUES("20","020","K0004","DRP","Dadar Gulung Pisang","1300","2500","pcs","0","","1","2","2","2023-07-22 06:10:04","2023-07-22 06:10:04");
INSERT INTO products VALUES("21","021","K0004","PM","Putri Mandi","2500","3000","pcs","0","","1","2","1","2023-07-22 06:15:41","2023-07-26 07:22:29");
INSERT INTO products VALUES("22","022","K0004","TOK","Kue Tok","2500","3000","pcs","0","","1","2","1","2023-07-22 06:16:33","2023-07-26 07:22:45");
INSERT INTO products VALUES("23","023","K0004","TOKS","Kue Tok Sadi","2000","3000","pcs","0","","1","2","2","2023-07-22 06:17:26","2023-07-22 06:17:26");
INSERT INTO products VALUES("24","024","K0004","WJ","Wajik","2000","3000","pcs","80","","1","2","2","2023-07-22 06:18:56","2023-08-02 02:10:30");
INSERT INTO products VALUES("25","025","K0004","WJH","Wajik Hijau","2000","3000","pcs","0","","1","2","2","2023-07-22 06:21:28","2023-07-22 06:21:28");
INSERT INTO products VALUES("26","026","K0004","LPS","Lapis Sadi","2000","3000","pcs","42","","1","2","2","2023-07-22 06:29:48","2023-08-02 02:10:30");
INSERT INTO products VALUES("27","027","K0004","TL","Tetel","1750","3000","pcs","42","","1","2","2","2023-07-22 06:32:31","2023-08-02 02:10:30");
INSERT INTO products VALUES("28","028","K0004","WJTL","Wajik Tetel Hantaran","135000","250000","pcs","0","","1","2","2","2023-07-22 06:35:23","2023-07-22 06:35:23");
INSERT INTO products VALUES("29","029","K0002","PSM","Pastel Mie","2500","3500","pcs","0","","1","2","2","2023-07-22 07:14:24","2023-07-22 07:14:24");
INSERT INTO products VALUES("30","030","K0002","PSG","Pastel Rogut","3000","4000","pcs","0","","1","2","2","2023-07-22 07:18:30","2023-07-22 07:18:30");
INSERT INTO products VALUES("31","031","K0004","CPR","Jajan Campur","1300","2500","pcs","0","","1","2","2","2023-07-22 07:21:24","2023-07-22 07:57:48");
INSERT INTO products VALUES("32","032","K0004","LBKR","Lumpur bkr","1800","3000","pcs","0","","1","2","2","2023-07-22 07:33:23","2023-07-22 07:33:23");
INSERT INTO products VALUES("33","033","K0004","RBW","Rainbow","1750","2500","pcs","0","","1","2","2","2023-07-22 07:46:41","2023-07-22 07:46:41");
INSERT INTO products VALUES("34","034","K0007","SMG","Semangka","1750","2500","pcs","0","","1","2","2","2023-07-22 07:50:10","2023-07-22 07:50:10");
INSERT INTO products VALUES("35","035","K0005","MOL","Pisang Molen","1200","2500","pcs","0","","1","2","2","2023-07-22 07:52:33","2023-07-22 07:52:33");
INSERT INTO products VALUES("36","036","K0008","NRT","Nasi Ratu","8000","9000","bungkus","42","","1","2","1","2023-07-22 08:02:25","2023-08-02 02:10:30");
INSERT INTO products VALUES("37","037","K0008","NKRW","Nasi Krawu","8000","9000","bungkus","0","","1","2","1","2023-07-22 08:04:45","2023-07-26 07:25:11");
INSERT INTO products VALUES("38","038","K0008","NRM","Nasi Rames","9000","10000","bungkus","8","","1","2","1","2023-07-22 08:08:47","2023-08-02 02:10:30");
INSERT INTO products VALUES("39","039","K0008","NGD","Nasi Gudeg","11000","12000","bungkus","0","","1","2","1","2023-07-22 08:12:35","2023-07-26 07:26:56");
INSERT INTO products VALUES("40","040","K0008","NGDT","Nasi Gudeg Tepak","12000","13000","tepak","0","","1","2","2","2023-07-22 08:16:01","2023-07-23 03:27:00");
INSERT INTO products VALUES("41","041","K0008","NRD","Nasi Rendang","11000","12000","bungkus","0","","1","2","1","2023-07-22 08:17:49","2023-07-26 07:25:36");
INSERT INTO products VALUES("42","042","K0008","NSA","Nasi Aria","10000","11000","bungkus","0","","1","2","1","2023-07-22 08:19:23","2023-07-26 07:28:06");
INSERT INTO products VALUES("43","043","K0008","NRC","Nasi Rechesee","10000","11000","pcs","0","","1","2","1","2023-07-22 08:21:57","2023-07-26 07:29:23");
INSERT INTO products VALUES("44","044","K0008","NGOR","Nasi Goreng","8000","9000","bungkus","20","","1","2","1","2023-07-22 08:24:04","2023-07-26 07:27:35");
INSERT INTO products VALUES("45","045","K0008","NGORT","Nasi Goreng Tepak","12000","13000","tepak","0","","1","2","1","2023-07-22 08:25:24","2023-07-26 07:27:30");
INSERT INTO products VALUES("46","046","K0008","NGORA","Nasi Goreng Aria","8000","9000","bungkus","0","","1","2","1","2023-07-22 08:26:53","2023-07-26 07:27:40");
INSERT INTO products VALUES("47","047","K0003","DNT45","Donat 45","1800","4500","pcs","191","","1","1","2","2023-07-22 08:28:26","2023-08-02 02:10:30");
INSERT INTO products VALUES("48","048","K0004","WJ25","Wajik 25","2000","2500","pcs","0","","1","2","2","2023-07-22 08:30:33","2023-07-22 08:32:51");
INSERT INTO products VALUES("49","049","K0004","WJH25","Wajik Hijau 25","2000","2500","pcs","0","","1","2","2","2023-07-22 08:32:10","2023-07-22 08:43:27");
INSERT INTO products VALUES("50","050","K0004","TL25","Tetel 25","1750","2500","pcs","0","","1","2","2","2023-07-22 08:37:42","2023-07-22 08:38:03");
INSERT INTO products VALUES("51","051","K0005","MOL2","Pisang Molen 2","1200","2000","pcs","0","","1","2","2","2023-07-22 08:39:13","2023-07-22 08:39:32");
INSERT INTO products VALUES("52","052","K0008","NRD13","Nasi Rendang 13","11000","13000","bungkus","0","","1","2","1","2023-07-22 08:40:41","2023-07-26 07:25:41");
INSERT INTO products VALUES("53","053","K0008","NRC12","Nasi Recheese","10000","12000","bungkus","0","","1","2","1","2023-07-22 08:42:14","2023-07-26 07:29:19");
INSERT INTO products VALUES("54","054","K0008","NGDT14","Nasi Gudeg Tepak 14","12000","14000","bungkus","0","","1","2","2","2023-07-23 03:27:32","2023-07-23 03:28:20");
INSERT INTO products VALUES("55","055","K0008","NKRW10","Nasi Kerawu 10","8000","10000","bungkus","0","","1","2","1","2023-07-23 03:30:51","2023-07-26 07:25:05");



CREATE TABLE `purchases` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_pur` text NOT NULL,
  `total_beli` int(10) unsigned NOT NULL,
  `total_retur` int(11) DEFAULT 0,
  `jml_bayar` int(11) NOT NULL,
  `date_pur` datetime NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_sale` (`id_pur`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO purchases VALUES("2","INV/B/23072023/0001","240000","0","240000","2023-07-23 19:57:39","","2023-07-23 19:57:39","2023-07-23 19:57:39");
INSERT INTO purchases VALUES("3","INV/B/23072023/0002","160000","0","160000","2023-07-23 20:01:17","","2023-07-23 20:01:17","2023-07-23 20:01:17");
INSERT INTO purchases VALUES("5","INV/B/23072023/0003","80000","0","80000","2023-07-23 20:03:12","","2023-07-23 20:03:12","2023-07-23 20:03:12");
INSERT INTO purchases VALUES("6","INV/B/23072023/0004","87500","0","87500","2023-07-23 20:04:41","","2023-07-23 20:04:41","2023-07-23 20:04:41");
INSERT INTO purchases VALUES("7","INV/B/23072023/0005","160000","0","160000","2023-07-23 20:06:06","","2023-07-23 20:06:06","2023-07-23 20:06:06");
INSERT INTO purchases VALUES("9","INV/B/23072023/0007","400000","0","400000","2023-07-23 20:09:45","","2023-07-23 20:09:45","2023-07-23 20:09:45");
INSERT INTO purchases VALUES("10","INV/B/23072023/0008","160000","0","160000","2023-07-23 20:12:43","","2023-07-23 20:12:43","2023-07-23 20:12:43");
INSERT INTO purchases VALUES("11","INV/B/23072023/0009","80000","0","80000","2023-07-23 20:24:14","","2023-07-23 20:24:14","2023-07-23 20:24:14");
INSERT INTO purchases VALUES("13","INV/B/26072023/0010","26000","0","26000","2023-07-26 19:58:44","","2023-07-26 19:58:44","2023-07-26 19:58:44");
INSERT INTO purchases VALUES("15","INV/B/20230805/0011","1300","0","1300","2023-08-02 16:12:47","","2023-08-02 16:12:47","2023-08-02 16:12:47");
INSERT INTO purchases VALUES("16","INV/B/20230805/0012","12000","0","12000","2023-08-05 00:00:00","","2023-08-02 16:16:17","2023-08-02 16:16:17");
INSERT INTO purchases VALUES("17","INV/B/20230801/0013","2000","0","2000","2023-08-01 00:00:00","","2023-08-02 16:16:57","2023-08-02 16:16:57");



CREATE TABLE `retails` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_retail` char(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `tlp` varchar(13) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('1','2') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_retail` (`id_retail`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO retails VALUES("5","RT0001","BU DHOFIK","RUNGKUT MADYA","","","1","2023-07-23 12:54:17","2023-07-23 12:54:17");



CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO roles VALUES("1","admin
","","");
INSERT INTO roles VALUES("2","sales","","");



CREATE TABLE `sales` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_sale` text NOT NULL,
  `total` int(10) unsigned NOT NULL,
  `total_retur` int(11) DEFAULT 0,
  `jml_retur` int(11) DEFAULT 0,
  `total_bersih` int(11) DEFAULT 0,
  `total_modal` int(11) DEFAULT 0,
  `diskon` int(11) DEFAULT 0,
  `date_sale` datetime NOT NULL,
  `status` enum('1','2') NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_sale` (`id_sale`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO sales VALUES("35","INV/J/20230802/0001","2000","2000","0","700","1300","0","2023-08-02 00:00:00","1","","2023-08-02 11:52:51","2023-08-02 11:52:51");
INSERT INTO sales VALUES("36","INV/J/20230802/0002","2000","2000","0","700","1300","0","2023-08-02 00:00:00","2","","2023-08-02 11:53:10","2023-08-02 11:53:10");
INSERT INTO sales VALUES("37","INV/J/20230802/0003","2000","2000","0","700","1300","0","2023-08-02 00:00:00","1","","2023-08-02 11:53:31","2023-08-02 11:53:31");
INSERT INTO sales VALUES("38","INV/J/20230801/0004","2000","2000","0","700","1300","0","2023-08-01 00:00:00","1","","2023-08-02 11:53:53","2023-08-02 11:53:53");
INSERT INTO sales VALUES("39","INV/J/20230728/0005","2000","2000","0","700","1300","0","2023-07-28 00:00:00","1","","2023-08-02 15:47:23","2023-08-02 15:47:23");
INSERT INTO sales VALUES("40","INV/J/20230707/0006","2000","2000","0","700","1300","0","2023-07-07 00:00:00","1","","2023-08-02 15:48:59","2023-08-02 15:48:59");
INSERT INTO sales VALUES("41","INV/J/20230701/0007","2000","2000","0","700","1300","0","2023-07-01 00:00:00","1","","2023-08-02 15:49:20","2023-08-02 15:49:20");



CREATE TABLE `suppliers` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_supplier` char(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `tlp` varchar(13) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_supplier` (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO suppliers VALUES("2","SP0001","LUMPIA","DINOYO","","","2023-07-23 12:55:35","2023-07-23 12:55:35");
INSERT INTO suppliers VALUES("3","SP0002","WAJIK","MENUR","","","2023-07-23 13:00:37","2023-07-23 13:00:37");
INSERT INTO suppliers VALUES("4","SP0003","TETEL","GEDANGAN","","","2023-07-23 13:04:01","2023-07-23 13:04:01");
INSERT INTO suppliers VALUES("5","SP0004","LEMPER","GUNUNGANYAR","","","2023-07-23 13:05:22","2023-07-23 13:05:22");
INSERT INTO suppliers VALUES("6","SP0005","RAMES","TENGGILIS","","","2023-07-23 13:06:53","2023-07-23 13:06:53");
INSERT INTO suppliers VALUES("7","SP0006","RATU","TENGGILIS","","","2023-07-23 13:08:24","2023-07-23 13:08:24");
INSERT INTO suppliers VALUES("8","SP0007","OYONG NASGOR","KENDANGSARI","","","2023-07-23 13:10:32","2023-07-23 13:10:32");
INSERT INTO suppliers VALUES("9","SP0008","LUMPIA BIJI","DINOYO","","","2023-07-23 13:22:16","2023-07-23 13:22:16");



CREATE TABLE `temp_orders` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_user` char(5) NOT NULL,
  `id_product` char(6) NOT NULL,
  `barcode` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `capital_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `qty` int(11) DEFAULT 1,
  `qty_retur` int(11) NOT NULL DEFAULT 0,
  `produksi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `units` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO units VALUES("17","pcs","2023-07-22 01:08:12","2023-07-22 01:08:12");
INSERT INTO units VALUES("18","bungkus","2023-07-22 01:08:20","2023-07-22 01:08:20");
INSERT INTO units VALUES("19","tepak","2023-07-22 01:08:24","2023-07-22 01:08:24");
INSERT INTO units VALUES("20","mika","2023-07-22 01:08:57","2023-07-22 01:08:57");



CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_roles` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES("1","A0001","1","Nia","nia@gmail.com","","$2y$10$qudY3xE9qgIrNMqOz.VP0uYCFIqI98AwW4/xPwbfRboSxFlFMrjVi","","","");
INSERT INTO users VALUES("2","A0002","1","Amir","amir@gmail.com","","$2y$10$x6vxmT1PEWIgpIHEk4FDjuyCEzm.M/P1/pD0Shr2K7EzC4S7Og7Ou","","","");
INSERT INTO users VALUES("3","A0003","1","Rafy","rafy@gmail.com","","$2y$10$K7FHp2BAZTA417HY/pWTH.yWHPLlhnAlwsS/2fbildD7JHdp99bAu","","","");

