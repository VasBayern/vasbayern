/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : vasbayern

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 18/10/2020 23:43:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for comment_contact
-- ----------------------------
DROP TABLE IF EXISTS `comment_contact`;
CREATE TABLE `comment_contact`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment_contact
-- ----------------------------
INSERT INTO `comment_contact` VALUES (1, 'Việt Anh', 'vastb98@gmail.com', 'Bán shop không???', 0, '2020-10-11 00:24:49', '2020-10-11 00:24:53');
INSERT INTO `comment_contact` VALUES (2, 'Việt Anh', 'vastb98@gmail.com', 'Bán đắt', 0, '2020-10-15 23:58:31', '2020-10-15 23:58:31');

-- ----------------------------
-- Table structure for comment_post
-- ----------------------------
DROP TABLE IF EXISTS `comment_post`;
CREATE TABLE `comment_post`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `comment_post_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `comment_post_post_id_foreign`(`post_id`) USING BTREE,
  CONSTRAINT `comment_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `content_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_post_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment_post
-- ----------------------------
INSERT INTO `comment_post` VALUES (1, 4, 2, 'ABC', '2020-10-15 23:56:18', '2020-10-15 23:56:18');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `review` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `rate` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `comments_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `comments_product_id_foreign`(`product_id`) USING BTREE,
  CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `shop_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for content_category
-- ----------------------------
DROP TABLE IF EXISTS `content_category`;
CREATE TABLE `content_category`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of content_category
-- ----------------------------
INSERT INTO `content_category` VALUES (1, 'Thời trang', 'thoi-trang', '2020-10-10 15:29:39', '2020-10-12 22:16:10');
INSERT INTO `content_category` VALUES (2, 'Khuyến mại', 'khuyen-mai', '2020-10-10 15:30:14', '2020-10-10 15:30:14');
INSERT INTO `content_category` VALUES (3, 'Hướng dẫn', 'huong-dan', '2020-10-10 15:30:49', '2020-10-10 15:30:49');

-- ----------------------------
-- Table structure for content_post
-- ----------------------------
DROP TABLE IF EXISTS `content_post`;
CREATE TABLE `content_post`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `view` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `content_post_category_id_foreign`(`category_id`) USING BTREE,
  INDEX `content_post_author_id_foreign`(`author_id`) USING BTREE,
  CONSTRAINT `content_post_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `content_post_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `content_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of content_post
-- ----------------------------
INSERT INTO `content_post` VALUES (1, 3, 'Nếu Đang Yêu Nhau Chỉ Cần Nhìn Mưa Sẽ Nhớ Nhau Hơn?', 'neu-dang-yeu-nhau-chi-can-nhin-mua-se-nho-nhau-hon', 'http://localhost/vasbayern/public/photos/1/blog/26912789715_73678b3f32_b.jpg', '<p>Thế nhưng sao chia tay lại sợ giọt mưa thấm đẫm cô đơn?</p>', '<div class=\"blog-detail-desc\"><p>Trời trắng xoá màu mưa, mọi thứ đang lu mờ quá nhanh. Phố vắng ướt nhoà đã khắc sâu hơn những nỗi buồn. Nhận ra ngần ấy năm, em vẫn không thuộc về anh, anh đã có tất cả nhưng tim em thì không. Và những gì đã từng tồn tại giữa hai chúng ta, có lẽ không phải tình yêu em mong đợi. Ngày mà em quyết rời anh mọi thứ cứ ngỡ vẫn nguyên vẹn. Nhưng thật ra từ sâu trong lòng anh hy vọng cuối đã tắt.</p></div><div class=\"blog-quote\"><p>Nếu đang yêu nhau chỉ cần nhìn mưa sẽ nhớ nhau hơn? Thế nhưng sao chia tay lại sợ giọt mưa thấm đẫm cô đơn. Cứ phải nghĩ hoài giờ ai kia đang ở đâu và đang vui như thế nào? Có ai chỉ còn một mình mà không ghét những cơn mưa? Lý do chia tay là gì, chẳng còn ý nghĩa cho ai. Khi người ở lại giờ đã mất đi tất cả. Chỉ muốn tin chính mình!</p></div><p>Oh no babe, sao em lại mang những cảm xúc sẻ chia với ai? Mang hết những ấm áp xa khỏi nơi tim anh? How you feel that I am breaking up inside when you leave my life, I get lost in my mind. Mưa làm đêm dài hơn em biết không? Anh lại mang ký ức trở về, sao anh không thể nào buông tay để quên được em?</p><div class=\"blog-quote\"><p>Nếu đang yêu nhau chỉ cần nhìn mưa sẽ nhớ nhau hơn? Thế nhưng sao chia tay lại sợ giọt mưa thấm đẫm cô đơn. Cứ phải nghĩ hoài giờ ai kia đang ở đâu và đang vui như thế nào? Có ai chỉ còn một mình mà không ghét những cơn mưa? Lý do chia tay là gì, chẳng còn ý nghĩa cho ai. Khi người ở lại giờ đã mất đi tất cả. Chỉ muốn tin chính mình!</p></div><p>Đã lâu ánh sáng Mặt Trời chẳng còn sưởi ấm nơi đây. Ký ức của đôi ta đang chìm dần vào trong góc tối tim anh. Chỉ còn đôi lần được mơ thấy ta lúc xưa, làm anh thêm nhớ em</p><div class=\"blog-quote\"><p>Nếu đang yêu nhau chỉ cần nhìn mưa sẽ nhớ nhau hơn? Thế nhưng sao chia tay lại sợ giọt mưa thấm đẫm cô đơn. Cứ phải nghĩ hoài giờ ai kia đang ở đâu và đang vui như thế nào? Có ai chỉ còn một mình mà không ghét những cơn mưa? Lý do chia tay là gì, chẳng còn ý nghĩa cho ai. Khi người ở lại giờ đã mất đi tất cả. Nhìn mưa tuôn nỗi đau!</p></div>', 1, 0, '2020-10-10 17:52:41', '2020-10-15 23:18:35');
INSERT INTO `content_post` VALUES (2, 3, 'Tại Sao Yêu Nhau Không Đến Được Với Nhau?', 'tai-sao-yeu-nhau-khong-den-duoc-voi-nhau', 'http://localhost/vasbayern/public/photos/1/blog/maxresdefault-2.jpg', '<p>Hôm nay, dành hết lầm lỗi để chia tay. Tình ta từ nay vỡ đôi, một dòng nước mắt lăn chạm qua môi</p>', '<div class=\"blog-detail-desc\"><p>Một thế giới hư ảo, nhưng thật ấm áp. Em xuất hiện khiến những băng giá đời anh bỗng dần tan đi. Cuộc đời anh đặt tên là muộn phiền nên làm sao dám mơ mình may mắn được trọn vẹn cùng em. Ta phải xa em mặc kệ nước mắt em rơi, vì những nguyên do cả đời không dám đối diện. Chỉ còn vài gang tấc nhưng lại xa xôi, tình mình tựa đôi đũa lệch đành buông trôi. Cầu mong em sẽ sớm quên được tất cả, tìm thấy một người, xứng đáng ở bên</p></div><div class=\"blog-quote\"><p>Từ nay duyên kiếp bỏ lại phía sau, ngày và bóng tối chẳng còn khác nhau. Chẳng có nơi nào yên bình được như em bên anh. Hạt mưa bỗng hoá thành màu nỗi đau, trời như muốn khóc ngày mình mất nhau. Có bao nhiêu đôi ngôn tình, cớ sao lìa xa mình ta?</p></div><p>Tại sao quá ngu ngốc bỏ lại mảnh ghép mà đối với nhau là tất cả, còn mình thì vụn vỡ... Thế giới thực tại ồn ào vẫn thấy cô đơn. Còn hai ta thì khác, chỉ nhìn thôi tim đã thấu. Từ nay duyên kiếp bỏ lại phía sau, ngày mà bóng tối chẳng còn khác nhau. Chẳng có nơi nào yên bình được như em bên anh. Hạt mưa bỗng hóa thàng màu nỗi đau, trời như muốn khóc ngày mình mất nhau. Có bao nhiêu đôi ngôn tình, Cớ sao lìa xa mình ta?</p>', 1, 0, '2020-10-10 18:09:53', '2020-10-15 23:17:59');
INSERT INTO `content_post` VALUES (3, 3, 'Chẳng Ai Có Thể Hiểu Nổi Được Trái Tim Khi Đã Lỡ Yêu Rồi', 'chang-ai-co-the-hieu-noi-duoc-trai-tim-khi-da-lo-yeu-roi', 'http://localhost/vasbayern/public/photos/1/blog/unnamed.png', '<p>Chỉ biết trách bản thân đã mù quáng, trót yêu một người vô tâm. Từng lời hứa như vết dao lạnh lùng cắm thật sâu trái tim này. Vì muốn thấy em hạnh phúc nên anh sẽ lùi về sau</p>', '<div class=\"blog-detail-desc\"><p>Chiều hôm ấy em nói với anh, rằng mình không nên gặp nhau nữa người ơi! Em đâu biết anh đau thế nào? Khoảng lặng phủ kín căn phòng ấy, tim anh như thắt lại. Và mong đó chỉ là mơ, vì anh còn yêu em rất nhiều.</p><p>Giọt buồn làm nhòe đi dòng kẻ mắt, hòa cùng cơn mưa là những nỗi buồn kia. Anh khóc cho cuộc tình chúng mình cớ sao còn yêu nhau mà mình, không thể đến được với nhau. Vì anh đã sai hay bởi vì bên em có ai kia?</p></div><div class=\"blog-quote\"><p>Chẳng ai có thể hiểu nổi được trái tim khi đã lỡ yêu rồi, chỉ biết trách bản thân đã mù quáng, trót yêu một người vô tâm. Từng lời hứa như vết dao lạnh lùng, cắm thật sâu trái tim này. Vì muốn thấy em hạnh phúc nên anh sẽ lùi về sau.</p></div><p>Thời gian qua chúng ta liệu sống tốt hơn, hay cứ mãi dối lừa? Nhìn người mình thương ướt nhòe mi cay khiến tim này càng thêm đau. Người từng khiến anh thay đổi là em, đã mãi xa rồi. Thôi giấc mơ khép lại, kí ức kia gửi theo, gió bay...</p>', 1, 0, '2020-10-10 18:39:40', '2020-10-15 23:17:30');
INSERT INTO `content_post` VALUES (4, 3, 'Suýt Nữa Thì Anh Có Thể Nói Được Ngàn Điều Muốn Nói', 'suyt-nua-thi-anh-co-the-noi-duoc-ngan-dieu-muon-noi', 'http://localhost/vasbayern/public/photos/1/blog/maxresdefault.jpg', '<p>Su&yacute;t nữa th&igrave; c&oacute; thể đ&egrave;o em, qua từng h&agrave;ng phố quen. D&ograve;ng lưu b&uacute;t năm xưa viết vội, hay c&ograve;n nhớ nhau đến những ng&agrave;y sau? T&igrave;nh y&ecirc;u đầu ti&ecirc;n anh giữ, vẫn vẹn nguy&ecirc;n nơi con tim n&agrave;y</p>', '<div class=\"blog-detail-desc\">\r\n<p>Suýt nữa thì \r\nanh có thể nói muôn vàn lời muốn nói. Suýt nữa thì \r\ncó thể đèo em, qua từng hàng phố quen. \r\nDòng lưu bút năm xưa viết vội, \r\nhay còn nhớ nhau đến những ngày sau. \r\nTình yêu đầu tiên anh giữ, vẫn vẹn nguyên nơi con tim này. \r\nAnh còn nhớ \r\nmỗi lúc tan trường ngại ngùng theo em. \r\nLà con phố, có hoa bay anh mãi theo sau, \r\nkhoảng cách ấy mà sao xa quá, \r\nchẳng thể nào để tới bên em. \r\nThời thanh xuân anh đang có là những nỗi buồn nuối tiếc.</p>\r\n</div>\r\n\r\n<div class=\"blog-quote\">\r\n<p>Lời chưa nói \r\nanh thả vào trong cơn gió nhắn với mây trời \r\nTình yêu đó \r\nchỉ riêng anh biết anh cũng chẳng mong hơn nhiều. \r\nLiệu rằng em còn ai đưa đón, \r\nanh ơ thờ dõi theo em. \r\nNếu có thể trở về hôm ấy \r\nanh sẽ chẳng để phí cơ hội. \r\nTừng vòng quay trên chiếc xe đạp anh đón đưa em ngang qua, \r\nthời thanh xuân, mà ta cùng nhau viết lên những giấc mơ đẹp. \r\nMột buổi chiều ngập tràn mảnh vỡ \r\nrơi ra từ hạnh phúc riêng anh. \r\nSuýt nữa thì người đã biết, \r\nyêu thương 1 thời anh đã tương tư \r\n\r\n</div>\r\n\r\n<p>Quả chò bay \r\nmuốn nhắc anh rằng hãy đừng nuối tiếc. \r\nVậy mà sao, chính anh vẫn mãi hy vọng. \r\nĐể rồi trên đoạn đường phía trước, \r\nta vô tình nhìn thấy nhau. \r\nLiệu bây giờ anh sẽ nói \r\nnhững tình yêu cất giữ bấy lâu. \r\nAi cũng phải \r\ngói cho mình khoảng trời ký ức, \r\nAi cũng phải có trong tim một vài vết thương. \r\nThời gian trôi chẳng chờ đợi ai, em đã được người đón ai đưa. \r\nTình yêu anh vẫn thế , vẫn mãi chôn vùi nơi đây </p>', 1, 0, '2020-10-10 18:42:51', '2020-10-10 18:42:54');

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ward` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` int(11) NOT NULL DEFAULT 0,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `customers_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'Việt Anh', '0346741998', 2, 'Hà Nội', 'Cầu Giấy', 'Yên Hòa', 'Số nhà 34 Ngõ 445 Nguyễn Khang', 0, NULL, '2020-10-18 20:06:10', '2020-10-18 22:46:43');
INSERT INTO `customers` VALUES (2, 'Nguyễn Văn Sang', '0346741998', 2, 'Thái Bình', 'Tiền Hải', 'Tây Giang', 'Xóm 8 Thôn Đoài', 0, NULL, '2020-10-18 20:06:24', '2020-10-18 22:46:43');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_09_30_085134_create_sessions_table', 1);
INSERT INTO `migrations` VALUES (7, '2020_09_30_155943_create_admins_table', 1);
INSERT INTO `migrations` VALUES (8, '2020_09_30_160125_create_shop_categories_table', 1);
INSERT INTO `migrations` VALUES (9, '2020_09_30_160246_create_shop_brands_table', 1);
INSERT INTO `migrations` VALUES (10, '2020_09_30_160330_create_shop_products_table', 1);
INSERT INTO `migrations` VALUES (11, '2020_09_30_160809_create_sizes_table', 1);
INSERT INTO `migrations` VALUES (12, '2020_09_30_160927_create_customers_table', 1);
INSERT INTO `migrations` VALUES (13, '2020_09_30_160953_create_product_properties_table', 1);
INSERT INTO `migrations` VALUES (14, '2020_09_30_161054_create_shop_coupons_table', 1);
INSERT INTO `migrations` VALUES (15, '2020_09_30_161202_create_order_table', 1);
INSERT INTO `migrations` VALUES (16, '2020_09_30_161426_create_order_detail_table', 1);
INSERT INTO `migrations` VALUES (17, '2020_09_30_161514_create_shop_banners_table', 1);
INSERT INTO `migrations` VALUES (18, '2020_09_30_161548_create_comments_table', 1);
INSERT INTO `migrations` VALUES (19, '2020_09_30_161710_create_content_category_table', 1);
INSERT INTO `migrations` VALUES (20, '2020_09_30_161735_create_content_post_table', 1);
INSERT INTO `migrations` VALUES (21, '2020_09_30_161803_create_comment_post_table', 1);
INSERT INTO `migrations` VALUES (22, '2020_09_30_161826_create_comment_contact_table', 1);
INSERT INTO `migrations` VALUES (23, '2020_09_30_161858_create_newsletter_table', 1);
INSERT INTO `migrations` VALUES (24, '2020_09_30_161930_create_wishlist_table', 1);
INSERT INTO `migrations` VALUES (25, '2020_10_04_135719_add_role_to_users', 2);
INSERT INTO `migrations` VALUES (26, '2020_10_04_140223_add_foregin_key_to_content_post', 2);
INSERT INTO `migrations` VALUES (27, '2020_10_04_140657_drop_table_admins', 2);
INSERT INTO `migrations` VALUES (28, '2016_06_01_000001_create_oauth_auth_codes_table', 3);
INSERT INTO `migrations` VALUES (29, '2016_06_01_000002_create_oauth_access_tokens_table', 3);
INSERT INTO `migrations` VALUES (30, '2016_06_01_000003_create_oauth_refresh_tokens_table', 3);
INSERT INTO `migrations` VALUES (31, '2016_06_01_000004_create_oauth_clients_table', 3);
INSERT INTO `migrations` VALUES (32, '2016_06_01_000005_create_oauth_personal_access_clients_table', 3);
INSERT INTO `migrations` VALUES (33, '2020_10_08_103924_add_slug_to_shop_brands', 4);
INSERT INTO `migrations` VALUES (34, '2020_10_10_144422_add_slug_to_content_category', 5);
INSERT INTO `migrations` VALUES (35, '2020_10_10_225226_add_slug_to_shop_banners', 6);
INSERT INTO `migrations` VALUES (36, '2020_10_14_154020_drop_table_order_detail', 7);
INSERT INTO `migrations` VALUES (37, '2020_10_14_154425_create_order_detail', 7);
INSERT INTO `migrations` VALUES (38, '2020_10_15_132606_create_permission_tables', 7);
INSERT INTO `migrations` VALUES (39, '2020_10_15_171212_create_tag_tables', 7);
INSERT INTO `migrations` VALUES (40, '2020_10_18_231113_create_jobs_table', 8);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for newsletter
-- ----------------------------
DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE `newsletter`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of newsletter
-- ----------------------------
INSERT INTO `newsletter` VALUES (1, 'vastb98@gmail.com', '2020-10-11 00:11:11', '2020-10-11 00:11:13');

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_access_tokens_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------
INSERT INTO `oauth_access_tokens` VALUES ('043caeaefebb2ead6632cdfeb6c525f9dec003d604006963ee1771efccbc9e86629d346eb6ec0ab1', 1, 1, 'Token', '[]', 0, '2020-10-06 17:12:34', '2020-10-06 17:12:34', '2021-10-06 17:12:34');
INSERT INTO `oauth_access_tokens` VALUES ('0bd399a6a039c54e436b88899335e6e8c1a0201c86fc37dbe4c034ad86bd30d1e9aa4dac83d14b2b', 1, 1, 'Token', '[]', 0, '2020-10-06 17:31:05', '2020-10-06 17:31:05', '2021-10-06 17:31:05');
INSERT INTO `oauth_access_tokens` VALUES ('2c4fcef0a0c43d023a5a21f8ddd34016f3bc4cbaa401f081948bd93bc47e2288a392ec8007cb8b58', NULL, 1, 'Token', '[]', 0, '2020-10-06 17:33:44', '2020-10-06 17:33:44', '2021-10-06 17:33:44');
INSERT INTO `oauth_access_tokens` VALUES ('45f0723106a3209242c2b41b8a631dc86fa81450f159370f5c24ae2947d1d12ccb8c0d8a95683841', 2, 1, 'Token', '[]', 0, '2020-10-09 00:36:19', '2020-10-09 00:36:19', '2021-10-09 00:36:19');
INSERT INTO `oauth_access_tokens` VALUES ('e52c74ff0e91509f5280759924cc9ae053a0586eecb2645fd1de866d3351503cf817e20388b1a0d8', 1, 1, 'Token', '[]', 0, '2020-10-06 17:20:24', '2020-10-06 17:20:24', '2021-10-06 17:20:24');

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_auth_codes_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_clients_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
INSERT INTO `oauth_clients` VALUES (1, NULL, 'Laravel Personal Access Client', 'clxlKvFFU4xQ5CLl9whs4X8jAOtZOuLsgOziqQRU', NULL, 'http://localhost', 1, 0, 0, '2020-10-06 16:59:46', '2020-10-06 16:59:46');
INSERT INTO `oauth_clients` VALUES (2, NULL, 'Laravel Password Grant Client', 'o5cNo3lWGqiVPK62rQig8Vgnx8ctOjbF8HN4QQJh', 'users', 'http://localhost', 0, 1, 0, '2020-10-06 16:59:46', '2020-10-06 16:59:46');

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
INSERT INTO `oauth_personal_access_clients` VALUES (1, 1, '2020-10-06 16:59:46', '2020-10-06 16:59:46');

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_refresh_tokens_access_token_id_index`(`access_token_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `shipment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` decimal(12, 0) NOT NULL,
  `ship_price` decimal(12, 0) NOT NULL,
  `promotion` decimal(12, 0) NOT NULL,
  `total` decimal(12, 0) NOT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `order_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (9, 2, 'Việt Anh', '0346741998', 'Số nhà 34 Ngõ 445 Nguyễn Khang ,Yên Hòa, Cầu Giấy, Hà Nội', NULL, '0', '1', 400000, 30000, 0, 430000, 'COD', '2020-10-18 23:09:46', '2020-10-18 23:09:46');
INSERT INTO `order` VALUES (10, 2, 'Việt Anh', '0346741998', 'Số nhà 34 Ngõ 445 Nguyễn Khang ,Yên Hòa, Cầu Giấy, Hà Nội', NULL, '0', '1', 400000, 30000, 0, 430000, 'COD', '2020-10-18 23:09:46', '2020-10-18 23:09:46');
INSERT INTO `order` VALUES (11, 2, 'Việt Anh', '0346741998', 'Số nhà 34 Ngõ 445 Nguyễn Khang ,Yên Hòa, Cầu Giấy, Hà Nội', NULL, '0', '1', 400000, 30000, 0, 430000, 'COD', '2020-10-18 23:10:27', '2020-10-18 23:10:27');
INSERT INTO `order` VALUES (12, 2, 'Việt Anh', '0346741998', 'Số nhà 34 Ngõ 445 Nguyễn Khang ,Yên Hòa, Cầu Giấy, Hà Nội', NULL, '0', '1', 400000, 30000, 0, 430000, 'COD', '2020-10-18 23:12:17', '2020-10-18 23:12:17');
INSERT INTO `order` VALUES (13, 2, 'Việt Anh', '0346741998', 'Số nhà 34 Ngõ 445 Nguyễn Khang ,Yên Hòa, Cầu Giấy, Hà Nội', NULL, '0', '1', 400000, 30000, 0, 430000, 'COD', '2020-10-18 23:12:17', '2020-10-18 23:12:17');

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(12, 0) NOT NULL,
  `total_price` decimal(12, 0) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_detail_order_id_foreign`(`order_id`) USING BTREE,
  INDEX `order_detail_product_id_foreign`(`product_id`) USING BTREE,
  INDEX `order_detail_size_id_foreign`(`size_id`) USING BTREE,
  CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `shop_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_detail_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_detail
-- ----------------------------
INSERT INTO `order_detail` VALUES (1, 11, 2, 1, 1, 400000, 400000, '2020-10-18 23:10:27', '2020-10-18 23:10:27');
INSERT INTO `order_detail` VALUES (2, 12, 2, 1, 1, 400000, 400000, '2020-10-18 23:12:17', '2020-10-18 23:12:17');
INSERT INTO `order_detail` VALUES (3, 13, 2, 1, 1, 400000, 400000, '2020-10-18 23:12:17', '2020-10-18 23:12:17');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('vastb98@gmail.com', '$2y$10$W9cM2WqBNcc9bOS5uMuM4un/At5V17huVEEzyW1zzKdVuymKON5re', '2020-09-30 17:21:45');

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for product_properties
-- ----------------------------
DROP TABLE IF EXISTS `product_properties`;
CREATE TABLE `product_properties`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_properties_product_id_foreign`(`product_id`) USING BTREE,
  INDEX `product_properties_size_id_foreign`(`size_id`) USING BTREE,
  CONSTRAINT `product_properties_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `shop_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_properties_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_properties
-- ----------------------------
INSERT INTO `product_properties` VALUES (1, 1, 1, 7, '2020-10-09 23:19:05', '2020-10-09 23:19:08');
INSERT INTO `product_properties` VALUES (2, 1, 2, 6, '2020-10-09 23:19:16', '2020-10-09 23:19:20');
INSERT INTO `product_properties` VALUES (3, 1, 3, 20, '2020-10-09 23:19:30', '2020-10-09 23:19:33');
INSERT INTO `product_properties` VALUES (4, 1, 4, 12, '2020-10-09 23:19:41', '2020-10-09 23:19:44');
INSERT INTO `product_properties` VALUES (5, 2, 1, 20, '2020-10-16 15:25:54', '2020-10-16 15:25:54');
INSERT INTO `product_properties` VALUES (6, 2, 2, 15, '2020-10-16 15:25:54', '2020-10-16 15:25:54');
INSERT INTO `product_properties` VALUES (7, 2, 3, 18, '2020-10-16 15:25:54', '2020-10-16 15:25:54');
INSERT INTO `product_properties` VALUES (8, 2, 4, 22, '2020-10-16 15:25:54', '2020-10-16 15:25:54');
INSERT INTO `product_properties` VALUES (9, 3, 1, 10, '2020-10-16 15:32:32', '2020-10-16 15:32:32');
INSERT INTO `product_properties` VALUES (10, 3, 2, 18, '2020-10-16 15:32:32', '2020-10-16 15:32:32');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id`) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_banners
-- ----------------------------
DROP TABLE IF EXISTS `shop_banners`;
CREATE TABLE `shop_banners`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `intro` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_banners
-- ----------------------------
INSERT INTO `shop_banners` VALUES (1, 'Main Banner', 'main-banner', '/categories/polo', 1, 'http://localhost/vasbayern/public/photos/1/banner/banner-1.jpg', '<p>Polo, T-shirt</p><h1>Black friday</h1><p>Áo Polo, T-shirt giảm sập sàn !!!</p>', '<h2>Sale 30%</h2>', '2020-10-10 23:40:35', '2020-10-15 23:14:39');
INSERT INTO `shop_banners` VALUES (2, 'Main Banner 2', 'main-banner-2', '/categories/so-mi', 1, 'http://localhost/vasbayern/public/photos/1/banner/banner-2.jpg', '<p>Sơ mi</p><h1>SIÊU SALE</h1><p>Sale siêu mạnh, giảm 50% áo Sơ mi&nbsp;</p>', '<h2>Sale 50%</h2>', '2020-10-10 23:45:01', '2020-10-15 23:15:31');
INSERT INTO `shop_banners` VALUES (3, 'Sale 1', 'sale-1', 'products/ao-so-mi-nam-ngan-tay-vasbayern-ass033s9', 2, 'http://localhost/vasbayern/public/photos/1/banner/banner-main.jpg', '<h2>Sơ Mi Sale</h2>', '<p><br></p>', '2020-10-10 23:49:42', '2020-10-15 23:16:15');
INSERT INTO `shop_banners` VALUES (4, 'Sale 2', 'sale-2', 'products/ao-so-mi-nam-ngan-tay-vasbayern-ass033s9', 3, 'http://localhost/vasbayern/public/photos/1/banner/banner-main-2.jpg', '<h2>Jeans Sale</h2>', '', '2020-10-16 14:09:38', '2020-10-16 14:10:18');
INSERT INTO `shop_banners` VALUES (5, 'Benefit 1', 'benefit-1', '#benefit-1', 4, 'http://localhost/vasbayern/public/front_ends/img/icon-1.png', '<h6 style=\"margin-top: 5px;\">Miễn phí giao hàng</h6>', '', '2020-10-16 13:33:10', '2020-10-16 13:33:10');
INSERT INTO `shop_banners` VALUES (6, 'Benefit 2', 'benefit-2', '#benefit-2', 4, 'http://localhost/vasbayern/public/front_ends/img/icon-2.png', '<h6 style=\"margin-top: 5px;\">Giao hàng đúng giờ</h6>', '', '2020-10-16 13:34:31', '2020-10-16 13:34:31');
INSERT INTO `shop_banners` VALUES (7, 'Benefit 3', 'benefit-3', '#benefit-3', 4, 'http://localhost/vasbayern/public/front_ends/img/icon-3.png', '<h6 style=\"margin-top: 5px;\">Bảo mật thông tin</h6>', '', '2020-10-16 13:35:09', '2020-10-16 13:35:09');

-- ----------------------------
-- Table structure for shop_brands
-- ----------------------------
DROP TABLE IF EXISTS `shop_brands`;
CREATE TABLE `shop_brands`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `shop_brands_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_brands
-- ----------------------------
INSERT INTO `shop_brands` VALUES (1, 'Adidas', 'adidas', 'http://localhost/fashion/fashion/public/storage/photos/2/blog/maxresdefault.jpg', '#2', '', '', '2020-10-08 21:34:35', '2020-10-10 18:23:47');
INSERT INTO `shop_brands` VALUES (2, 'Uniqlo', 'uniqlo', 'http://localhost/fashion/fashion/public/storage/photos/2/blog/maxresdefault.jpg', '#2', '', '', '2020-10-08 21:34:50', '2020-10-10 18:23:35');
INSERT INTO `shop_brands` VALUES (3, 'Aristino', 'aristino', 'http://localhost/fashion/fashion/public/storage/photos/2/blog/maxresdefault.jpg', '#1', '', '', '2020-10-08 21:36:12', '2020-10-10 18:23:26');
INSERT INTO `shop_brands` VALUES (4, 'Việt Anh', 'viet-anh', 'http://localhost/fashion/fashion/public/storage/photos/2/blog/maxresdefault.jpg', '#12', '', '', '2020-10-10 19:18:39', '2020-10-10 19:18:39');

-- ----------------------------
-- Table structure for shop_categories
-- ----------------------------
DROP TABLE IF EXISTS `shop_categories`;
CREATE TABLE `shop_categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `intro` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `homepage` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `shop_categories_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_categories
-- ----------------------------
INSERT INTO `shop_categories` VALUES (1, 'Polo', 'polo', 0, 'http://localhost/vasbayern/public/photos/1/blog/maxresdefault.jpg', '<p>a</p>', '', 1, '2020-10-06 15:22:02', '2020-10-15 23:12:56');
INSERT INTO `shop_categories` VALUES (2, 'T-Shirt', 't-shirt', 0, 'http://localhost/vasbayern/public/photos/1/blog/maxresdefault.jpg', '', '', 1, '2020-10-06 15:47:43', '2020-10-12 22:20:47');
INSERT INTO `shop_categories` VALUES (3, 'Sơ Mi', 'so-mi', 0, 'http://localhost/vasbayern/public/photos/1/blog/maxresdefault.jpg', '', '', 1, '2020-10-06 15:47:59', '2020-10-10 18:31:45');
INSERT INTO `shop_categories` VALUES (4, 'Quần Âu', 'quan-au', 0, 'http://localhost/vasbayern/public/photos/1/blog/maxresdefault.jpg', '', '', 1, '2020-10-10 19:15:08', '2020-10-16 14:18:22');
INSERT INTO `shop_categories` VALUES (5, 'Quần Kaki', 'quan-kaki', 0, 'http://localhost/vasbayern/public/photos/1/blog/maxresdefault.jpg', '', '', 1, '2020-10-16 14:18:46', '2020-10-16 14:18:46');
INSERT INTO `shop_categories` VALUES (6, 'Quần Jeans', 'quan-jeans', 0, 'http://localhost/vasbayern/public/photos/1/blog/maxresdefault.jpg', '', '', 1, '2020-10-16 14:19:04', '2020-10-16 14:19:04');
INSERT INTO `shop_categories` VALUES (7, 'Quần Short', 'quan-short', 0, 'http://localhost/vasbayern/public/photos/1/blog/maxresdefault.jpg', '', '', 1, '2020-10-16 14:19:23', '2020-10-16 14:19:23');

-- ----------------------------
-- Table structure for shop_coupons
-- ----------------------------
DROP TABLE IF EXISTS `shop_coupons`;
CREATE TABLE `shop_coupons`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NULL DEFAULT NULL,
  `percent_off` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `shop_coupons_code_unique`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_coupons
-- ----------------------------
INSERT INTO `shop_coupons` VALUES (1, 'vietanhdeptrai', 'percent', 0, 90, '2020-10-08 22:40:43', '2020-10-08 22:40:43');
INSERT INTO `shop_coupons` VALUES (2, 'VAS', 'price', 200000, 0, '2020-10-08 22:41:30', '2020-10-08 22:41:30');
INSERT INTO `shop_coupons` VALUES (3, 'coupon', 'price', 43333, 0, '2020-10-08 22:42:44', '2020-10-08 22:54:20');
INSERT INTO `shop_coupons` VALUES (4, 'vietanh', 'price', 500000, 0, '2020-10-08 22:44:52', '2020-10-08 22:45:56');

-- ----------------------------
-- Table structure for shop_products
-- ----------------------------
DROP TABLE IF EXISTS `shop_products`;
CREATE TABLE `shop_products`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `priceCore` decimal(12, 0) NOT NULL,
  `priceSale` decimal(12, 0) NULL DEFAULT 0,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `homepage` int(11) NOT NULL DEFAULT 0,
  `new` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `shop_products_name_unique`(`name`) USING BTREE,
  INDEX `shop_products_cat_id_foreign`(`cat_id`) USING BTREE,
  INDEX `shop_products_brand_id_foreign`(`brand_id`) USING BTREE,
  CONSTRAINT `shop_products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `shop_brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `shop_products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `shop_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_products
-- ----------------------------
INSERT INTO `shop_products` VALUES (1, 'ÁO POLO VASBAYERN APS084S9109', 'ao-polo-vasbayern-aps084s9109', '[\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS014S9-02.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS014S9-01.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS014S9-15.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS014S9.jpg\"]', '<p>Áo Polo đẹp</p>', '<p><strong>KIỂU DÁNG:&nbsp;</strong>SLIM FIT</p><p><strong>CHI TIẾT:</strong></p><p>- Áo Polo phom dáng Slim fit ôm vừa vặn cơ thể, trẻ trung và tôn dán.</p><p>- Thiết kế cơ bản, cổ và gấu tay áo dệt rib tạo họa tiết mới lạ. Áo có màu sắc cơ bản, có thể kết hợp với nhiều trang phục khác nhau trong nhiều hoàn cảnh khác nhau.</p><p><strong>CHẤT LIỆU</strong>:</p><p>- Chất liệu Cupro cao cấp từ sợi xơ hạt bông quý hiếm, kết hợp Polycool cho sản phẩm tăng cường độ mềm mại, đứng dáng và thoáng mát gấp 2,5 lần so với sợi thường.</p><p>- Áo co giãn nhờ kết hợp sợi Spandex.</p>', 400000, 350000, 1, 3, 1, 1, '2020-10-09 22:25:23', '2020-10-15 23:04:53');
INSERT INTO `shop_products` VALUES (2, 'ÁO POLO NAM VASBAYERN APS014S9', 'ao-polo-nam-vasbayern-aps014s9', '[\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS038S9-09.jpg\",\"http:\\/\\/localhost\\/fvasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS038S9-07.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS038S9-08.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS038S9-10.jpg\"]', '<p>Áo Polo đẹp</p>', '<p><strong>KIỂU DÁNG:&nbsp;</strong>SLIM FIT</p><p><strong>CHI TIẾT:</strong></p><p>- Áo Polo phom dáng Slim fit ôm vừa vặn cơ thể, trẻ trung và tôn dán.</p><p>- Thiết kế cơ bản, cổ và gấu tay áo dệt rib tạo họa tiết mới lạ. Áo có màu sắc cơ bản, có thể kết hợp với nhiều trang phục khác nhau trong nhiều hoàn cảnh khác nhau.</p><p><strong>CHẤT LIỆU</strong>:</p><p>- Chất liệu Cupro cao cấp từ sợi xơ hạt bông quý hiếm, kết hợp Polycool cho sản phẩm tăng cường độ mềm mại, đứng dáng và thoáng mát gấp 2,5 lần so với sợi thường.</p><p>- Áo co giãn nhờ kết hợp sợi Spandex.</p>', 450000, 400000, 1, 3, 1, 1, '2020-10-09 22:27:54', '2020-10-15 23:06:59');
INSERT INTO `shop_products` VALUES (3, 'ÁO POLO NAM VASBAYERN APS082S9', 'ao-polo-nam-vasbayern-aps082s9', '[\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS074S8-10.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS074S8-09.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS074S8-08.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS074S8-07.jpg\"]', '<p>Áo Polo đẹp</p>', '<p><strong>KIỂU DÁNG:&nbsp;</strong>SLIM FIT</p><p><strong>CHI TIẾT:</strong></p><p>- Áo Polo phom dáng Slim fit ôm vừa vặn cơ thể, trẻ trung và tôn dán.</p><p>- Thiết kế cơ bản, cổ và gấu tay áo dệt rib tạo họa tiết mới lạ. Áo có màu sắc cơ bản, có thể kết hợp với nhiều trang phục khác nhau trong nhiều hoàn cảnh khác nhau.</p><p><strong>CHẤT LIỆU</strong>:</p><p>- Chất liệu Cupro cao cấp từ sợi xơ hạt bông quý hiếm, kết hợp Polycool cho sản phẩm tăng cường độ mềm mại, đứng dáng và thoáng mát gấp 2,5 lần so với sợi thường.</p><p>- Áo co giãn nhờ kết hợp sợi Spandex.</p>', 400000, 0, 1, 3, 1, 1, '2020-10-09 22:29:17', '2020-10-15 23:07:26');
INSERT INTO `shop_products` VALUES (4, 'ÁO POLO NAM VASBAYERN APS021S9', 'ao-polo-nam-vasbayern-aps021s9', '[\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS084S9-02.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS084S9-04.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS084S9-01.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/polo\\/ao-polo-nam-aristino-APS084S9.jpg\"]', '<p>Áo Polo đẹp</p>', '<p><strong>KIỂU DÁNG:&nbsp;</strong>SLIM FIT</p><p><strong>CHI TIẾT:</strong></p><p>- Áo Polo phom dáng Slim fit ôm vừa vặn cơ thể, trẻ trung và tôn dán.</p><p>- Thiết kế cơ bản, cổ và gấu tay áo dệt rib tạo họa tiết mới lạ. Áo có màu sắc cơ bản, có thể kết hợp với nhiều trang phục khác nhau trong nhiều hoàn cảnh khác nhau.</p><p><strong>CHẤT LIỆU</strong>:</p><p>- Chất liệu Cupro cao cấp từ sợi xơ hạt bông quý hiếm, kết hợp Polycool cho sản phẩm tăng cường độ mềm mại, đứng dáng và thoáng mát gấp 2,5 lần so với sợi thường.</p><p>- Áo co giãn nhờ kết hợp sợi Spandex.</p>', 450000, 0, 1, 3, 1, 1, '2020-10-09 22:30:12', '2020-10-15 23:07:52');
INSERT INTO `shop_products` VALUES (5, 'ÁO T-SHIRT VASBAYERN ATS021S9', 'ao-t-shirt-vasbayern-ats021s9', '[\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS004S9-10.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS004S9-11.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS004S9-09.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS004S9-08.jpg\"]', 't-shirt', '<p><span style=\"font-weight: bolder;\">KIỂU DÁNG:&nbsp;</span>SLIM FIT</p><p><span style=\"font-weight: bolder;\">CHI TIẾT:</span></p><p>- Áo Polo phom dáng Slim fit ôm vừa vặn cơ thể, trẻ trung và tôn dán.</p><p>- Thiết kế cơ bản, cổ và gấu tay áo dệt rib tạo họa tiết mới lạ. Áo có màu sắc cơ bản, có thể kết hợp với nhiều trang phục khác nhau trong nhiều hoàn cảnh khác nhau.</p><p><span style=\"font-weight: bolder;\">CHẤT LIỆU</span>:</p><p>- Chất liệu Cupro cao cấp từ sợi xơ hạt bông quý hiếm, kết hợp Polycool cho sản phẩm tăng cường độ mềm mại, đứng dáng và thoáng mát gấp 2,5 lần so với sợi thường.</p><p>- Áo co giãn nhờ kết hợp sợi Spandex.</p>', 500000, 0, 2, 3, 1, 1, '2020-10-09 23:02:08', '2020-10-15 23:08:14');
INSERT INTO `shop_products` VALUES (6, 'ÁO T-SHIRT NAM VASBAYERN ATS004S9', 'ao-t-shirt-nam-vasbayern-ats004s9', '[\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS005S9-12.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS005S9-13.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS005S9-11.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS005S9-10.jpg\"]', '<p>t-shirt</p>', '<p><span style=\"font-weight: bolder;\">KIỂU DÁNG:&nbsp;</span>SLIM FIT</p><p><span style=\"font-weight: bolder;\">CHI TIẾT:</span></p><p>- Áo Polo phom dáng Slim fit ôm vừa vặn cơ thể, trẻ trung và tôn dán.</p><p>- Thiết kế cơ bản, cổ và gấu tay áo dệt rib tạo họa tiết mới lạ. Áo có màu sắc cơ bản, có thể kết hợp với nhiều trang phục khác nhau trong nhiều hoàn cảnh khác nhau.</p><p><span style=\"font-weight: bolder;\">CHẤT LIỆU</span>:</p><p>- Chất liệu Cupro cao cấp từ sợi xơ hạt bông quý hiếm, kết hợp Polycool cho sản phẩm tăng cường độ mềm mại, đứng dáng và thoáng mát gấp 2,5 lần so với sợi thường.</p><p>- Áo co giãn nhờ kết hợp sợi Spandex.</p>', 450000, 400000, 2, 1, 1, 1, '2020-10-09 23:02:55', '2020-10-15 23:08:38');
INSERT INTO `shop_products` VALUES (7, 'ÁO T-SHIRT NAM VASBAYERN ATS009S9', 'ao-t-shirt-nam-vasbayern-ats009s9', '[\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS016S9-05.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS016S9-07.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS016S9-06.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS016S9-04.jpg\"]', '<p>t-shirt</p>', '<p><span style=\"font-weight: bolder;\">KIỂU DÁNG:&nbsp;</span>SLIM FIT</p><p><span style=\"font-weight: bolder;\">CHI TIẾT:</span></p><p>- Áo Polo phom dáng Slim fit ôm vừa vặn cơ thể, trẻ trung và tôn dán.</p><p>- Thiết kế cơ bản, cổ và gấu tay áo dệt rib tạo họa tiết mới lạ. Áo có màu sắc cơ bản, có thể kết hợp với nhiều trang phục khác nhau trong nhiều hoàn cảnh khác nhau.</p><p><span style=\"font-weight: bolder;\">CHẤT LIỆU</span>:</p><p>- Chất liệu Cupro cao cấp từ sợi xơ hạt bông quý hiếm, kết hợp Polycool cho sản phẩm tăng cường độ mềm mại, đứng dáng và thoáng mát gấp 2,5 lần so với sợi thường.</p><p>- Áo co giãn nhờ kết hợp sợi Spandex.</p>', 550000, 450000, 2, 3, 1, 1, '2020-10-09 23:03:28', '2020-10-15 23:09:02');
INSERT INTO `shop_products` VALUES (8, 'ÁO T-SHIRT NAM VASBAYERN ATS032S8', 'ao-t-shirt-nam-vasbayern-ats032s8', '[\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS021S9-03.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS021S9-02.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS021S9-01.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/t-shirt\\/ao-thun-nam-aristino-ATS021S9.jpg\"]', '<p>t-shirt</p>', '<p><span style=\"font-weight: bolder;\">KIỂU DÁNG:&nbsp;</span>SLIM FIT</p><p><span style=\"font-weight: bolder;\">CHI TIẾT:</span></p><p>- Áo Polo phom dáng Slim fit ôm vừa vặn cơ thể, trẻ trung và tôn dán.</p><p>- Thiết kế cơ bản, cổ và gấu tay áo dệt rib tạo họa tiết mới lạ. Áo có màu sắc cơ bản, có thể kết hợp với nhiều trang phục khác nhau trong nhiều hoàn cảnh khác nhau.</p><p><span style=\"font-weight: bolder;\">CHẤT LIỆU</span>:</p><p>- Chất liệu Cupro cao cấp từ sợi xơ hạt bông quý hiếm, kết hợp Polycool cho sản phẩm tăng cường độ mềm mại, đứng dáng và thoáng mát gấp 2,5 lần so với sợi thường.</p><p>- Áo co giãn nhờ kết hợp sợi Spandex.</p>', 12000000, 400000, 2, 1, 1, 1, '2020-10-09 23:03:59', '2020-10-15 23:09:26');
INSERT INTO `shop_products` VALUES (9, 'ÁO SƠ MI NAM NGẮN TAY VASBAYERN ASS033S9', 'ao-so-mi-nam-ngan-tay-vasbayern-ass033s9', '[\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-aristino-ASS033S9.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-aristino-ASS033S9-02.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-aristino-ASS033S9-01.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-nam-aristino-ASS033S9.jpg\"]', '<p>Sơ Mi</p>', '<p><span style=\"font-weight: bolder;\">KIỂU DÁNG:&nbsp;</span>SLIM FIT</p><p><span style=\"font-weight: bolder;\">CHI TIẾT:</span></p><p>- Áo Polo phom dáng Slim fit ôm vừa vặn cơ thể, trẻ trung và tôn dán.</p><p>- Thiết kế cơ bản, cổ và gấu tay áo dệt rib tạo họa tiết mới lạ. Áo có màu sắc cơ bản, có thể kết hợp với nhiều trang phục khác nhau trong nhiều hoàn cảnh khác nhau.</p><p><span style=\"font-weight: bolder;\">CHẤT LIỆU</span>:</p><p>- Chất liệu Cupro cao cấp từ sợi xơ hạt bông quý hiếm, kết hợp Polycool cho sản phẩm tăng cường độ mềm mại, đứng dáng và thoáng mát gấp 2,5 lần so với sợi thường.</p><p>- Áo co giãn nhờ kết hợp sợi Spandex.</p>', 600000, 550000, 3, 3, 1, 1, '2020-10-09 23:04:38', '2020-10-15 23:09:49');
INSERT INTO `shop_products` VALUES (10, 'ÁO SƠ MI DÀI TAY NAM VASBAYERN ALS00909', 'ao-so-mi-dai-tay-nam-vasbayern-als00909', '[\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-nam-aristino-ALS00909-01.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-nam-aristino-ALS00909-02.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-nam-aristino-ALS00909.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-nam-aristino-ALS00909-03.jpg\"]', '<p>Sơ mi</p>', '<p><span style=\"font-weight: bolder;\">KIỂU DÁNG:&nbsp;</span>SLIM FIT</p><p><span style=\"font-weight: bolder;\">CHI TIẾT:</span></p><p>- Áo Polo phom dáng Slim fit ôm vừa vặn cơ thể, trẻ trung và tôn dán.</p><p>- Thiết kế cơ bản, cổ và gấu tay áo dệt rib tạo họa tiết mới lạ. Áo có màu sắc cơ bản, có thể kết hợp với nhiều trang phục khác nhau trong nhiều hoàn cảnh khác nhau.</p><p><span style=\"font-weight: bolder;\">CHẤT LIỆU</span>:</p><p>- Chất liệu Cupro cao cấp từ sợi xơ hạt bông quý hiếm, kết hợp Polycool cho sản phẩm tăng cường độ mềm mại, đứng dáng và thoáng mát gấp 2,5 lần so với sợi thường.</p><p>- Áo co giãn nhờ kết hợp sợi Spandex.</p>', 600000, 500000, 3, 3, 1, 1, '2020-10-09 23:05:10', '2020-10-15 23:10:14');
INSERT INTO `shop_products` VALUES (11, 'ÁO SƠ MI NGẮN TAY VASBAYERN ASS107S9', 'ao-so-mi-ngan-tay-vasbayern-ass107s9', '[\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-aristino-ASS107S9-01.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-aristino-ASS107S9.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-aristino-ASS107S9-02.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-nam-aristino-ASS107S9.jpg\"]', '<p>Sơ Mi</p>', '<p><span style=\"font-weight: bolder;\">KIỂU DÁNG:&nbsp;</span>SLIM FIT</p><p><span style=\"font-weight: bolder;\">CHI TIẾT:</span></p><p>- Áo Polo phom dáng Slim fit ôm vừa vặn cơ thể, trẻ trung và tôn dán.</p><p>- Thiết kế cơ bản, cổ và gấu tay áo dệt rib tạo họa tiết mới lạ. Áo có màu sắc cơ bản, có thể kết hợp với nhiều trang phục khác nhau trong nhiều hoàn cảnh khác nhau.</p><p><span style=\"font-weight: bolder;\">CHẤT LIỆU</span>:</p><p>- Chất liệu Cupro cao cấp từ sợi xơ hạt bông quý hiếm, kết hợp Polycool cho sản phẩm tăng cường độ mềm mại, đứng dáng và thoáng mát gấp 2,5 lần so với sợi thường.</p><p>- Áo co giãn nhờ kết hợp sợi Spandex.</p>', 650000, 0, 3, 3, 1, 1, '2020-10-09 23:05:40', '2020-10-15 23:10:48');
INSERT INTO `shop_products` VALUES (12, 'ÁO SƠ MI NGẮN TAY BAYERN ASS105S9', 'ao-so-mi-ngan-tay-bayern-ass105s9', '[\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-aristino-ASS105S9.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-aristino-ASS105S9-02.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-aristino-ASS105S9-01.jpg\",\"http:\\/\\/localhost\\/vasbayern\\/public\\/photos\\/1\\/product\\/so-mi\\/ao-so-mi-nam-aristino-ASS105S9.jpg\"]', '<p>Sơ mi</p>', '<p><span style=\"font-weight: bolder;\">KIỂU DÁNG:&nbsp;</span>SLIM FIT</p><p><span style=\"font-weight: bolder;\">CHI TIẾT:</span></p><p>- Áo Polo phom dáng Slim fit ôm vừa vặn cơ thể, trẻ trung và tôn dán.</p><p>- Thiết kế cơ bản, cổ và gấu tay áo dệt rib tạo họa tiết mới lạ. Áo có màu sắc cơ bản, có thể kết hợp với nhiều trang phục khác nhau trong nhiều hoàn cảnh khác nhau.</p><p><span style=\"font-weight: bolder;\">CHẤT LIỆU</span>:</p><p>- Chất liệu Cupro cao cấp từ sợi xơ hạt bông quý hiếm, kết hợp Polycool cho sản phẩm tăng cường độ mềm mại, đứng dáng và thoáng mát gấp 2,5 lần so với sợi thường.</p><p>- Áo co giãn nhờ kết hợp sợi Spandex.</p>', 650000, 550000, 3, 3, 1, 1, '2020-10-09 23:06:33', '2020-10-15 23:11:12');

-- ----------------------------
-- Table structure for sizes
-- ----------------------------
DROP TABLE IF EXISTS `sizes`;
CREATE TABLE `sizes`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sizes
-- ----------------------------
INSERT INTO `sizes` VALUES (1, 'S', '2020-10-08 21:55:59', '2020-10-08 21:55:59');
INSERT INTO `sizes` VALUES (2, 'M', '2020-10-08 21:56:05', '2020-10-08 21:56:05');
INSERT INTO `sizes` VALUES (3, 'L', '2020-10-08 21:56:11', '2020-10-08 21:56:11');
INSERT INTO `sizes` VALUES (4, 'XL', '2020-10-08 21:56:17', '2020-10-08 21:56:40');

-- ----------------------------
-- Table structure for taggables
-- ----------------------------
DROP TABLE IF EXISTS `taggables`;
CREATE TABLE `taggables`  (
  `tag_id` int(10) UNSIGNED NOT NULL,
  `taggable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL,
  UNIQUE INDEX `taggables_tag_id_taggable_id_taggable_type_unique`(`tag_id`, `taggable_id`, `taggable_type`) USING BTREE,
  INDEX `taggables_taggable_type_taggable_id_index`(`taggable_type`, `taggable_id`) USING BTREE,
  CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order_column` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `profile_photo_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `provider_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Nguyễn Việt Anh', 'vasbayernshop@gmail.com', '2020-10-18 14:10:45', '$2y$10$SHjkMByPYlb1phtuAzuh5Ot9jfqCMtfD119mlh5OVDHbkc2bm0Mga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-04 14:10:43', '2020-10-04 14:10:43', 1);
INSERT INTO `users` VALUES (2, 'Việt Anh', 'vastb98@gmail.com', '2020-10-04 14:15:50', '$2y$10$W0l4Dq31bIanCbt/cYMVo.X1t.6FU7xqvPg86l2mPr1WQEjtv2Kd6', NULL, NULL, NULL, NULL, NULL, '1603020740.jpeg', NULL, NULL, '2020-10-04 14:11:31', '2020-10-18 18:32:20', 2);

-- ----------------------------
-- Table structure for wishlist
-- ----------------------------
DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `wishlist_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `wishlist_product_id_foreign`(`product_id`) USING BTREE,
  CONSTRAINT `wishlist_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `shop_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wishlist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
