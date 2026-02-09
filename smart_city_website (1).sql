-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 06, 2023 at 04:46 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_city_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vacancy_id` int(11) NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_of_study` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educational_level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` longtext COLLATE utf8mb4_unicode_ci,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_of_graduation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `vacancy_id`, `full_name`, `gender`, `field_of_study`, `educational_level`, `experience`, `phone`, `email`, `age`, `year_of_graduation`, `cv`, `attachments`, `comment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Biruk Fekade', 'Male', 'Quia sint officiis', 'Saepe esse sit mole', 'Accusamus quod iure', '0949904135', 'birukdevelopment@gmail.com', '11', '1983', 'software-developer-2023-09-04-64f622d4f110c.pdf', NULL, NULL, '2023-09-04 15:32:53', '2023-09-04 15:32:53', NULL),
(2, 1, 'Cara Bruce', 'Male', 'Libero eaque officia', 'Nostrum cupiditate e', 'Et ut ducimus inven', '0921122213', 'vose@mailinator.com', '96', '2008', 'software-developer-2023-09-04-64f625d2c3f2d.pdf', NULL, NULL, '2023-09-04 15:45:38', '2023-09-04 15:45:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_am` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_am` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_or` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_or` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `title_am`, `subtitle_am`, `title_en`, `subtitle_en`, `title_or`, `subtitle_or`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, '-2023-08-26-64e9a73f42162.jpg', 'የአዲስ አበባ ከተማ ኢኖቬሽንና ቴክኖሎጂ ልማት ቢሮ (ITDB)', 'ለነዋሪዎቹ እና ለጎብኚዎቹ ምቹ የሆኑ ዋና ዋና የአይቲ ቴክኖሎጂዎችን መተግበር; አዲስ አበባን እንደ ዘላቂ እና የማይበገር ከተማ ማየት።', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB)', 'Implementing major IT technologies that are convenient for its residents and visitors; seeing Addis Ababa as a sustainable and resilient city.', 'Biiroo Misooma Innooveeshinii fi Teeknooloojii Magaalaa Addis Ababa (ITDB)', 'teeknooloojiiwwan IT gurguddoo jiraattotaa fi daawwattoota isaaf mijatoo ta’an hojiirra oolchuu;', '2023-08-26 04:18:23', '2023-08-30 02:27:45', '2023-08-30 02:27:45', 1),
(2, '-2023-08-30-64eed2f04265b.jpeg', 'የአዲስ አበባ ከተማ ኢኖቬሽንና ቴክኖሎጂ ልማት ቢሮ (ITDB)', 'አዳዲስ ሀሳቦችን ይደግፉ እና ዛሬ ለውጥ ያድርጉ። በእርስዎ ማህበረሰብ ውስጥ ኢንቨስት ያድርጉ፣ ለወደፊቱ ኢንቨስት ያድርጉ።', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB)', 'Implementing major IT technologies that are convenient for its residents and visitors; seeing Addis Ababa as a sustainable and resilient city.', 'Biiroo Misooma Innooveeshinii fi Teeknooloojii Magaalaa Addis Ababa (ITDB)', 'teeknooloojiiwwan IT gurguddoo jiraattotaa fi daawwattoota isaaf mijatoo ta’an hojiirra oolchuu;', '2023-08-30 02:26:08', '2023-09-04 03:27:25', NULL, 1),
(3, '-2023-08-30-64eed36d6d266.jpeg', 'የአዲስ አበባ ከተማ ኢኖቬሽንና ቴክኖሎጂ ልማት ቢሮ (ITDB)', 'አዳዲስ ሀሳቦችን ይደግፉ እና ዛሬ ለውጥ ያድርጉ። በእርስዎ ማህበረሰብ ውስጥ ኢንቨስት ያድርጉ፣ ለወደፊቱ ኢንቨስት ያድርጉ።', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB)', 'Implementing major IT technologies that are convenient for its residents and visitors; seeing Addis Ababa as a sustainable and resilient city.', 'Biiroo Misooma Innooveeshinii fi Teeknooloojii Magaalaa Addis Ababa (ITDB)', 'teeknooloojiiwwan IT gurguddoo jiraattotaa fi daawwattoota isaaf mijatoo ta’an hojiirra oolchuu;', '2023-08-30 02:28:13', '2023-08-30 02:28:56', '2023-08-30 02:28:56', 1),
(4, '-2023-08-30-64eed3b02245f.jpg', 'የአዲስ አበባ ከተማ ኢኖቬሽንና ቴክኖሎጂ ልማት ቢሮ (ITDB)', 'አዳዲስ ሀሳቦችን ይደግፉ እና ዛሬ ለውጥ ያድርጉ። በእርስዎ ማህበረሰብ ውስጥ ኢንቨስት ያድርጉ፣ ለወደፊቱ ኢንቨስት ያድርጉ።', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB)', 'Implementing major IT technologies that are convenient for its residents and visitors; seeing Addis Ababa as a sustainable and resilient city.', 'Biiroo Misooma Innooveeshinii fi Teeknooloojii Magaalaa Addis Ababa (ITDB)', 'teeknooloojiiwwan IT gurguddoo jiraattotaa fi daawwattoota isaaf mijatoo ta’an hojiirra oolchuu;', '2023-08-30 02:29:20', '2023-08-31 14:19:59', NULL, 0),
(5, '-2023-08-30-64ef36b382ac3.jpg', 'የአዲስ አበባ ከተማ ኢኖቬሽንና ቴክኖሎጂ ልማት ቢሮ (ITDB)', 'አዳዲስ ሀሳቦችን ይደግፉ እና ዛሬ ለውጥ ያድርጉ። በእርስዎ ማህበረሰብ ውስጥ ኢንቨስት ያድርጉ፣ ለወደፊቱ ኢንቨስት ያድርጉ።', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB)', 'Implementing major IT technologies that are convenient for its residents and visitors; seeing Addis Ababa as a sustainable and resilient city.', 'Biiroo Misooma Innooveeshinii fi Teeknooloojii Magaalaa Addis Ababa (ITDB)', 'teeknooloojiiwwan IT gurguddoo jiraattotaa fi daawwattoota isaaf mijatoo ta’an hojiirra oolchuu;', '2023-08-30 09:31:47', '2023-08-31 14:16:14', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `blog_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `blog_title`, `blog_slug`, `description`, `blog_image`, `blog_category_id`, `posted_by`, `link_video`, `views`, `deleted_at`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Debitis veritatis nihil velit omnis consequatur ipsum.', 'debitis-veritatis-nihil-velit-omnis-consequatur-ipsum', 'Libero quaerat veritatis ut eligendi repudiandae dolores. Adipisci laborum ut nobis omnis. Voluptas repellat porro sapiente natus enim blanditiis. Qui corrupti doloremque ad laboriosam odio quo et.\n\nQuas natus velit quia reiciendis sed. Voluptates voluptatem autem autem nesciunt maiores. Non rerum repudiandae aut est.\n\nPerferendis ut voluptatem accusantium quia voluptates. Ut error voluptates ut eum odio quasi voluptas. Sed ut in odio sint ut aut commodi dolor. Voluptatibus soluta qui perferendis consequatur.\n\nAccusamus id quidem doloremque aspernatur deserunt. Iure illum fugiat veniam vitae. Cumque et amet enim occaecati.\n\nCumque earum eius cum temporibus aliquam dolor ratione. Error et vel laborum et quo quis veritatis quidem. Autem et enim doloribus voluptas.', '\"blog5.jpg\"', '5', '1', 'https://youtu.be/NMx4ZEIYPzc?si=UQhprZH418g40ggw', 0, NULL, '2023-08-26 05:30:27', '2023-08-26 05:30:27', 1),
(2, 'Maxime hic quos ex tempora vel eum.', 'maxime-hic-quos-ex-tempora-vel-eum', 'Et sed ad et repudiandae voluptas. Eaque reiciendis sunt eum repellendus harum sed odio. Quibusdam nobis veritatis ratione iusto dolores.\n\nRepudiandae maiores optio modi id. Sapiente ipsam veniam et maiores deserunt nisi qui. Sequi iste assumenda occaecati sed magnam provident et illo. Dolore qui aut qui dolore quos.\n\nHic perspiciatis enim dolorum dolore aut. Totam et ratione esse at eaque nihil. Vel harum temporibus laudantium doloribus autem autem. Qui velit id ipsum.\n\nEx molestiae officia sit atque voluptas. Rerum provident ut quasi ad quas sint porro. Et sed iste dignissimos accusantium culpa in. Quidem accusantium pariatur ut.\n\nCulpa corporis sint dicta neque libero numquam. Omnis et corporis quasi consequatur id maxime. Modi sequi occaecati consequuntur voluptas et.', '\"blog3.jpg\"', '1', '1', 'https://youtu.be/NMx4ZEIYPzc?si=UQhprZH418g40ggw', 0, NULL, '2023-08-26 05:30:28', '2023-08-26 05:30:28', 1),
(3, 'Consequatur ut quaerat dolor.', 'consequatur-ut-quaerat-dolor', 'Laudantium aperiam quia ipsum quisquam quia. Beatae repudiandae magnam et temporibus. Fuga aut dolorem distinctio quo. Sit ab eligendi vitae doloribus quas qui facilis.\n\nEst voluptatem rerum laborum sint. Sunt fugiat quae architecto. Adipisci recusandae qui iusto dolore cum dolores quis. Pariatur corrupti fugit perferendis in.\n\nPorro quo sit ea ex. Sequi quidem reprehenderit nulla quod quibusdam corporis. Et consequatur harum in quia numquam neque enim.\n\nDolores vitae veniam qui quis voluptatem velit numquam minima. Ut repellendus ut eos distinctio porro ipsam aut.\n\nOptio rerum magni facere veritatis fugit harum alias. Dolore molestiae sit beatae pariatur cupiditate doloribus illo necessitatibus.', '\"blog1.jpg\"', '3', '1', 'https://youtu.be/NMx4ZEIYPzc?si=UQhprZH418g40ggw', 0, NULL, '2023-08-26 05:30:28', '2023-08-26 05:30:28', 1),
(4, 'Sint ullam eos tenetur.', 'sint-ullam-eos-tenetur', 'Enim sit sunt animi praesentium. Aliquam ratione et nulla aut consectetur saepe dignissimos exercitationem. Quis rerum recusandae numquam aliquid. Suscipit assumenda dolorum tempora repellat libero dolor animi aut.\n\nDolores temporibus quia quaerat labore qui ut ab. Quia quasi sunt excepturi itaque. Fugit nostrum perspiciatis excepturi. Autem ut quia cumque voluptates nam occaecati doloribus. Magni tempore dolores esse saepe dolores molestias beatae.\n\nBlanditiis culpa est modi. Ipsa temporibus aperiam et dolorum aut culpa sint dolore. Aut voluptas quod ipsam aspernatur. Inventore sed aliquam nobis ut.\n\nSimilique et aperiam nemo sit impedit. Repellat rerum id consectetur debitis blanditiis excepturi rerum.\n\nEst voluptatem aut nam non. Ut est animi et est quia. Quia corrupti error officiis neque.', '\"blog2.jpg\"', '1', '1', 'https://youtu.be/NMx4ZEIYPzc?si=UQhprZH418g40ggw', 0, NULL, '2023-08-26 05:30:28', '2023-08-26 05:30:28', 1),
(5, 'Iste non neque vero repellendus.', 'iste-non-neque-vero-repellendus', 'Maiores fugiat et explicabo quo. Voluptatem hic et magni eum omnis. Quis ut voluptate unde consequuntur est. Harum voluptate maxime quia eius.\n\nEst id hic voluptatum ut nesciunt velit architecto. Provident magni cupiditate impedit dolor. Et consequatur consequatur quas ipsa officia itaque. Blanditiis explicabo ipsum est nihil necessitatibus consequatur et.\n\nIpsa id est soluta nesciunt dicta rerum. Inventore ut labore fuga dolor explicabo assumenda.\n\nAliquid et voluptate minima quia harum enim sint perferendis. Ut quia enim repellat et. Ad incidunt earum veritatis eius harum. At porro voluptas ad quia ipsa exercitationem cum pariatur. Sit porro consequatur est repudiandae tenetur.\n\nInventore quia natus odio debitis. Quas in non accusamus quod repellat. Voluptatibus qui velit voluptates qui.', '\"blog4.jpg\"', '2', '1', 'https://youtu.be/NMx4ZEIYPzc?si=UQhprZH418g40ggw', 0, NULL, '2023-08-26 05:30:28', '2023-08-26 05:30:28', 1),
(6, 'Eveniet et voluptatem distinctio id.', 'eveniet-et-voluptatem-distinctio-id', 'Soluta iure vel quia rerum voluptatem blanditiis. Tempora omnis molestiae laudantium inventore accusantium ea. Occaecati quae cum eum id tempora hic.\n\nVoluptatibus consequatur ducimus aut. Laboriosam voluptatum hic vel aut necessitatibus. Vel fugiat eveniet consectetur voluptatem sunt. Ullam commodi beatae est dolore eos explicabo autem.\n\nIpsa quam in voluptatem minus impedit tenetur. Deleniti sapiente soluta voluptatem qui rerum cum. Quo sint fuga praesentium est incidunt consequatur qui. Animi rerum voluptate officia quo ipsum unde sit.\n\nError numquam sed nemo voluptas laborum quae est debitis. Consequuntur rerum culpa quas debitis ea. Nobis ipsam reprehenderit qui consequuntur dolores dicta. Fuga reiciendis doloremque maiores voluptas molestiae nostrum.\n\nConsequatur veritatis voluptatibus vero ex consequatur est. Sapiente at perferendis nulla voluptas voluptate. Quis laborum veritatis ducimus nostrum vel magnam magni. Ratione inventore libero reprehenderit velit.', '\"blog1.jpg\"', '2', '1', 'https://youtu.be/NMx4ZEIYPzc?si=UQhprZH418g40ggw', 0, NULL, '2023-08-26 05:30:28', '2023-08-26 05:30:28', 1),
(7, 'Quas et dolorum incidunt enim saepe at.', 'quas-et-dolorum-incidunt-enim-saepe-at', 'Impedit accusamus aut esse officiis quisquam perspiciatis adipisci qui. Ut libero praesentium perspiciatis saepe. Voluptatibus quisquam culpa sit exercitationem. Accusantium possimus dolores explicabo earum architecto.\n\nDolore est dolorum perferendis repellendus in debitis quia consequatur. Impedit dolorem enim harum ut fuga quis accusantium fugit. Totam voluptatem repellat beatae corrupti sequi vel est. Et quidem et similique minus.\n\nMaiores voluptatem placeat quasi repellat nobis. Sint quo sint possimus ut. Sequi atque necessitatibus quis.\n\nAut sequi molestiae aut modi voluptas sed. Eum aut id eligendi. Dolores odio iusto voluptatem quae sint. Suscipit eos qui eveniet voluptatum molestiae deleniti.\n\nOdit vitae velit est rerum laudantium. Aspernatur sit et qui eveniet praesentium sed architecto quae. Tempore dignissimos hic sapiente et. Veritatis reiciendis cupiditate ipsam eaque deleniti.', '\"blog2.jpg\"', '3', '1', 'https://youtu.be/NMx4ZEIYPzc?si=UQhprZH418g40ggw', 0, NULL, '2023-08-26 05:30:28', '2023-08-26 05:30:28', 1),
(8, 'Et eum qui natus.', 'et-eum-qui-natus', 'Laboriosam itaque repellendus tempore et. Sed quisquam quis repellat debitis. Numquam voluptates quibusdam esse occaecati provident aut.\n\nNesciunt aut excepturi laborum quis impedit eum. Laboriosam et aut consequuntur earum ipsum. Quibusdam id iure voluptatibus facere porro.\n\nIncidunt sit hic dolore assumenda veritatis ut. Et enim esse corrupti tenetur fugiat soluta. Quis neque itaque est id. Repellendus vel cumque aliquid ut eos.\n\nEst sed quia facilis dolore est. Dignissimos enim a inventore nam autem magnam aut. Hic quae ut quod ea consectetur blanditiis minus. Nam tempore porro magnam adipisci laborum non.\n\nEst aspernatur animi in ut aut. Ab voluptatum doloribus cum. Fuga quia occaecati iste eos dicta soluta. Quisquam totam aut repellendus est et non facere. Perspiciatis rerum esse ea hic autem.', '\"blog4.jpg\"', '3', '1', 'https://youtu.be/NMx4ZEIYPzc?si=UQhprZH418g40ggw', 0, NULL, '2023-08-26 05:30:28', '2023-08-26 05:30:28', 1),
(9, 'Tenetur autem dolor autem quo ullam.', 'tenetur-autem-dolor-autem-quo-ullam', 'Nemo molestiae illo fuga minus provident est eum. Aliquam impedit excepturi non iure quibusdam et atque. Vel laudantium maxime enim eos corporis temporibus voluptas ut.\n\nUt culpa est qui quis. Nulla dicta error aut aliquid explicabo. A qui et sit ratione nihil.\n\nCommodi facilis libero sunt sit. Cupiditate velit doloremque aut porro molestiae beatae sapiente. Corrupti adipisci quod ut ab. Error nihil labore rem qui ut reprehenderit.\n\nExplicabo impedit quis asperiores qui dicta error. Dolorem quos maiores ducimus sed esse dignissimos expedita corporis. Recusandae architecto qui laudantium soluta. Dolor autem et enim repellendus tenetur impedit atque placeat.\n\nVelit ducimus velit illum possimus delectus est excepturi et. Beatae blanditiis molestiae et repellendus deserunt voluptatem suscipit. Sed quia ut amet quibusdam animi dolorum fugit. Amet eos nihil necessitatibus aut consequatur aut saepe inventore.', '\"blog5.jpg\"', '3', '1', 'https://youtu.be/NMx4ZEIYPzc?si=UQhprZH418g40ggw', 0, NULL, '2023-08-26 05:30:28', '2023-08-26 05:30:28', 1),
(10, 'Libero officia cumque ratione.', 'libero-officia-cumque-ratione', 'Omnis maiores ducimus perferendis non et facere libero. Animi ut alias pariatur tempora officia. Id a sunt repellendus ea. Asperiores inventore doloribus sunt aut occaecati qui aut numquam. Eos aut sit esse asperiores dolor.\n\nVeritatis nulla aut maiores ad alias deserunt. Est et sunt quasi voluptas non animi vero. Possimus dolorem ex perspiciatis repellat possimus cum.\n\nRerum corrupti deleniti laudantium quos assumenda. Deleniti laudantium distinctio labore autem maxime.\n\nEst amet consequatur a culpa reprehenderit. Optio consequatur labore et iure quia vitae. Numquam a commodi molestias ullam iste.\n\nAtque id deleniti et porro iure. Aut fuga repudiandae maxime sit aut. Eius consequatur ea iure dignissimos. Recusandae et id ut praesentium qui et.', '\"blog3.jpg\"', '1', '1', 'https://youtu.be/NMx4ZEIYPzc?si=UQhprZH418g40ggw', 0, NULL, '2023-08-26 05:30:28', '2023-08-26 05:30:28', 1),
(11, 'Transforming Addis Ababa: The Role of Innovation and Technology', 'transforming-addis-ababa-the-role-of-innovation-and-technology', '<p>In the heart of Ethiopia lies Addis Ababa, a city with a rich history and vibrant culture. Over the years, this metropolis has been striving to embrace the future while honoring its past. One key player in this transformation is the Addis Ababa City Innovation and Technology Development Bureau (ITDB), a government organization established in April 2009 GC under proclamation No. 11/2009. What started as an agency has now evolved into a dynamic bureau structure, poised to lead the city into an era of innovation and technological advancement.</p>\r\n\r\n<p>**The Evolution of ITDB: Building a Strong Foundation**</p>\r\n\r\n<p>The journey of the ITDB began as an agency focused on innovation and technology back in 2009. However, it wasn&#39;t until September 2019 GC that a significant restructuring took place, elevating the organization to a bureau structure. This transformation was a strategic move by the city&#39;s administration to streamline service delivery across various sectors using the power of innovation, technology knowledge, and research expertise.</p>\r\n\r\n<p>Fast forward to 2023, and the ITDB enters its third phase of re-institution, marked by Proclamation No.74/2015. This latest reorganization aims to address the challenges faced by residents during service delivery, ushering in an era where technology becomes the cornerstone of efficiency, accessibility, and progress.</p>\r\n\r\n<p>**Empowering the City through Innovation and Technology**</p>\r\n\r\n<p>At its core, the ITDB is entrusted with a broad range of responsibilities that center on innovation, technology development, and creating a digital infrastructure. One of its primary tasks is conducting research to enhance existing technologies and create new ones. By focusing on these advancements, the bureau ensures that the city remains at the forefront of technological progress.</p>\r\n\r\n<p>Information systems and ICT infrastructure form the backbone of a smart city, and the ITDB is at the helm of their development. This includes not only building these systems but also upholding standards, ensuring quality, safety, and reliability in their implementation. The bureau also takes on the role of monitoring and supporting the city&#39;s IT infrastructures, optimizing existing systems to tackle the diverse political, social, and economic challenges faced by the city.</p>\r\n\r\n<p>**Vision 2025: A Glimpse into the Future**</p>\r\n\r\n<p>The ITDB&#39;s vision for the future is both ambitious and inspiring. By 2025, they envision the implementation of major IT technologies that bring convenience to the city&#39;s residents and visitors. The goal isn&#39;t just technological advancement but also making Addis Ababa a sustainable and resilient city, ready to tackle the challenges of the modern world.</p>\r\n\r\n<p>**Mission: Enhancing Lives through Technology**</p>\r\n\r\n<p>The ITDB&#39;s mission revolves around benefiting the people of Addis Ababa. This is achieved through the implementation of technology-driven infrastructures, backed by thorough research and a focus on secure systems. By expanding digital services, the bureau aims to bring the city&#39;s services to the fingertips of its citizens and visitors, creating a more efficient and connected environment for everyone.</p>\r\n\r\n<p>**Values: Guiding Principles for Transformation**</p>\r\n\r\n<p>Guided by a set of values that include availability, affordability, accessibility, sustainability, resilience, and more, the ITDB is committed to not only bringing technological change but also ensuring it&#39;s for the betterment of the city and its inhabitants. These values encapsulate the bureau&#39;s commitment to responsible, meaningful, and impactful technological innovation.</p>\r\n\r\n<p>**Conclusion: Building a Bright Future**</p>\r\n\r\n<p>The Addis Ababa City Innovation and Technology Development Bureau stands as a beacon of progress, showcasing the transformative power of innovation and technology. From its humble beginnings as an agency to its current role as a driving force behind the city&#39;s evolution, the ITDB&#39;s journey is a testament to the city&#39;s determination to create a brighter future. As we look ahead, it&#39;s clear that with the ITDB leading the charge, Addis Ababa is not just a city with a rich history, but also a city with a promising future, one where innovation and technology are the keys to unlocking its true potential.</p>', '\"64e9baf1127f4.photo_2022-10-14_17-40-21.jpg\"', '1', '1', 'https://youtu.be/NMx4ZEIYPzc?si=UQhprZH418g40ggw', 0, NULL, '2023-08-26 05:42:25', '2023-08-26 06:02:39', 1),
(12, 'ከተማችንን ስማርት ሲቲ (Smart City) ለማድረግ የተጀመረው ጥረት ተጠናክሮ ቀጥሏል፡፡', 'smart-city', '<p>ከተማችንን ስማርት ሲቲ (Smart City) ለማድረግ የተጀመረው ጥረት ተጠናክሮ ቀጥሏል፡፡<br />\r\nየከተማችን አስተዳደር ከተማዋን የሚያዘምንና የሚያሻሽል የቴክኖሎጂ ሲስተምና መሰረተ ልማት በመገንባት እያጋጠመ &nbsp;ያለውን የአገልግሎት ችግሮች እንዲሁም የሌብነትና ሙስና ማነቆዎችን በዘላቂነት ለመፍታት እንቅስቃሴ እያደረገ ይገኛል፡፡<br />\r\nዛሬ በአዲስ አበባ የሳይንስና ቴክኖሎጂ ዩንቨርሲቲ ተጠንቶ በቀረበ ጥናት ላይ ከባለድርሻ አካላት ጋር ውይይት አካሂደናል፡፡<br />\r\nበውይይታችንም በጥናቱ ግኝት እና ምክረሃሳብ መሰረት የሁሉንም ባለድርሻ ተቋም ብቃት እና አቅም በመጠቀም &nbsp;የከተማዋን የአገልግሎት አሰጣጥ ችግር በዘመናዊ &nbsp;ቴክኖሎጂ በመታገዝ &nbsp;መፍትሄ ለመስጠት የጀመርነውን ስራ ስራ አጠናክረን ለመቀጠል አቅጣጫ አስቀምጠናል፡፡<br />\r\nፈጣሪ ኢትዮጵያንና ህዝቦቿን አብዝቶ ይባርክ!!<br />\r\nMagalaa keenya Magaalaa ammayyooftuu (Smart City ) taasisuuf tattaaffiin eegalame cimee itti fufeera.<br />\r\nBulchiinsi magaalaa keenyaa tooftaa &nbsp;teeknooloojii ( Technology System ) magaalattii &nbsp;ammayyoomsuu fi fooyyeessuun bu&#39;uura misoomaa ijaaruun rakkoolee tajaajila isa mudachaa jiru akkasumas hannaa fi malaammaltummaa buqqisuu fi &nbsp;itti fufinsaan furuuf sochii taasisuutti argama.&nbsp;<br />\r\nHar&#39;a qorannoo Yuunivarsiitii Saayinsii fi Teeknooloojii Finfinnee irratti qoratamee dhiyaate qaamota dhimmi ilaallatu waliin marii adeemsifneerra.&nbsp;<br />\r\nMarii keenyaanis qorannicha bu&#39;uura &nbsp;argannoo fi yaada marii qaama dhaabbilee &nbsp;hundaa gahumsaa fi cimina fayyadamuun rakkoo kenninsa tajaajila &nbsp;magaalattii deeggarsa teeknooloojii ammayyaan furmaata kennuuf hojii eegalle cimsinee itti fufuuf kallattii keenyerra.&nbsp;<br />\r\nWaaqni Itoophiyaa fi uummata ishee baay&#39;isee haa eebbisu!!<br />\r\n&nbsp;</p>', '\"64ef190766297.316824137_700347731657900_1045188864464420546_n.jpg\"', '1', '2', 'https://www.youtube.com/watch?v=ETnLewwT2qQ', 0, NULL, '2023-08-30 07:25:11', '2023-08-30 07:25:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Technology Trends', 'technology-trends-2023-08-26-64e9ad4ac551d.png', '2023-08-26 04:44:10', '2023-08-31 14:55:13', NULL, 0),
(2, 'Health and Wellness', 'health-and-wellness-2023-08-26-64e9ae4f4bc9c.png', '2023-08-26 04:48:31', '2023-08-26 04:48:31', NULL, 1),
(3, 'Travel and Adventure', 'travel-and-adventure-2023-08-26-64e9ae5e37031.png', '2023-08-26 04:48:46', '2023-08-26 04:48:46', NULL, 1),
(4, 'Food', 'food-2023-08-26-64e9ae6fd2197.png', '2023-08-26 04:49:03', '2023-08-26 04:49:03', NULL, 1),
(5, 'Finance', 'finance-2023-08-26-64e9ae7cced1f.png', '2023-08-26 04:49:16', '2023-08-26 04:49:16', NULL, 1),
(6, 'Entertainment', 'entertainment-2023-08-26-64e9ae8ed066f.png', '2023-08-26 04:49:34', '2023-08-26 04:49:34', NULL, 1),
(7, 'Uncategorized', 'uncategorized-2023-08-26-64e9aef2c3ae0.png', '2023-08-26 04:51:14', '2023-08-26 04:51:14', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `blog_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `email`, `name`, `phone`, `message`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'davijyk@mailinator.com', 'Sylvester Slater', '64', 'Sed obcaecati anim o', '2023-08-27 15:45:06', '2023-08-27 15:45:06', NULL, 1),
(2, 'lyhoponun@mailinator.com', 'Maris Burns', '3', 'Qui sint id exceptur', '2023-08-27 15:46:53', '2023-08-27 15:46:53', NULL, 1),
(3, 'jutene@mailinator.com', 'Hu Holder', '+1 (682) 436-3331', 'Inventore ducimus q', '2023-08-29 08:27:12', '2023-08-29 08:27:12', NULL, 1),
(4, 'weldefekade@gmail.com', 'Subscription', 'Subscription', 'Subscription', '2023-08-29 09:11:22', '2023-08-29 09:11:22', NULL, 1),
(5, 'bkfekade@gmail.com', 'Subscription', 'Subscription', 'Subscription', '2023-08-31 15:55:16', '2023-08-31 15:55:16', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `director_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `director_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vice_director` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vice_director_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `slug`, `description`, `director_name`, `director_photo`, `department_photo`, `vice_director`, `icon`, `vice_director_photo`, `created_at`, `updated_at`, `user_id`, `status`) VALUES
(1, 'City Administration of Addis Ababa Innovation and Technology Development Bureau Head', 'city-administration-of-addis-ababa-innovation-and-technology-development-bureau-head', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB) is a government organization that was originally constituted as an agency in April 2009 GC under proclamation No. 11/2009. The agency had been incorporated with the Technique and Vocational Training Agency and acquired a bureau structure as a result of the restructuring of the city\'s executive bodies in September 2019 GC. The institution has been carrying out various activities since the time it is established in the level of agency up to these days with a view to realize the vision to see building up of bridge to transform the city to overall ICT.', 'Ato Solomon Amare', 'ato-lemma-2023-08-29-64ee566b2e7d8.jpg', 'ato-lemma-2023-08-29-64ee566b2eded.jpg', 'Ato Lemma', 'fa-regular fa-lightbulb', 'ato-solomon-amare-2023-08-29-64ee566b2ce52.jpg', '2023-08-29 17:34:51', '2023-09-01 04:53:37', 1, 1),
(2, 'Smart City Sector /Deputy Head/', 'smart-city-sector-deputy-head', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB) is a government organization that was originally constituted as an agency in April 2009 GC under proclamation No. 11/2009. The agency had been incorporated with the Technique and Vocational Training Agency and acquired a bureau structure as a result of the restructuring of the city\'s executive bodies in September 2019 GC. The institution has been carrying out various activities since the time it is established in the level of agency up to these days with a view to realize the vision to see building up of bridge to transform the city to overall ICT.', 'Dr. Tulu Tilahun', 'dr-tulu-tilahun-2023-08-30-64ef2d277cdda.jpg', 'dr-tulu-tilahun-2023-08-30-64ef2d2793bae.jpg', 'Ato Lemma', 'fa-regular fa-lightbulb', 'dr-tulu-tilahun-2023-08-29-64ee56d682f52.jpg', '2023-08-29 17:36:38', '2023-08-30 08:51:03', 1, 1),
(3, 'Innovation and Technology Development Sector /Deputy Head/', 'innovation-and-technology-development-sector-deputy-head', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB) is a government organization that was originally constituted as an agency in April 2009 GC under proclamation No. 11/2009. The agency had been incorporated with the Technique and Vocational Training Agency and acquired a bureau structure as a result of the restructuring of the city\'s executive bodies in September 2019 GC. The institution has been carrying out various activities since the time it is established in the level of agency up to these days with a view to realize the vision to see building up of bridge to transform the city to overall ICT.', 'Ato Yemane Desalegn', 'ato-lemma-2023-08-29-64ee57190b361.jpg', 'ato-lemma-2023-08-29-64ee57190b9ee.jpg', 'Ato Lemma', 'fa-regular fa-lightbulb', 'ato-yemane-desalegn-2023-08-29-64ee57190821d.jpg', '2023-08-29 17:37:45', '2023-08-29 17:37:45', 1, 1),
(4, 'Information Technology Operation and Service Sector /Deputy Head/', 'information-technology-operation-and-service-sector-deputy-head', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB) is a government organization that was originally constituted as an agency in April 2009 GC under proclamation No. 11/2009. The agency had been incorporated with the Technique and Vocational Training Agency and acquired a bureau structure as a result of the restructuring of the city\'s executive bodies in September 2019 GC. The institution has been carrying out various activities since the time it is established in the level of agency up to these days with a view to realize the vision to see building up of bridge to transform the city to overall ICT.', 'Ato Mihretu Desalegn', 'ato-lemma-2023-08-29-64ee5742a19a5.jpg', 'ato-lemma-2023-08-29-64ee5742a5f32.jpg', 'Ato Lemma', 'fa-regular fa-lightbulb', 'ato-mihretu-desalegn-2023-08-29-64ee5742a1274.jpg', '2023-08-29 17:38:26', '2023-08-29 17:38:26', 1, 1),
(6, 'Kermit Yates', 'kermit-yates', 'Deserunt distinctio', 'Brielle Abbott', 'paula-barr-2023-09-05-64f6cefbdfa46.png', 'paula-barr-2023-09-05-64f6cefbe0367.png', 'Paula Barr', 'on-ios-analytics-outline', 'brielle-abbott-2023-09-05-64f6cefbdb7e0.png', '2023-09-05 03:47:23', '2023-09-05 03:47:23', 1, 1),
(7, 'Azalia Delaney', 'azalia-delaney', 'Facilis tenetur et d', 'Serena Clayton', 'keegan-pate-2023-09-05-64f6cf36146db.jpg', 'keegan-pate-2023-09-05-64f6cf3615481.png', 'Keegan Pate', 'fa-regular fa-lightbulb', 'serena-clayton-2023-09-05-64f6cf36140ed.jpg', '2023-09-05 03:48:22', '2023-09-05 03:48:22', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `directorates`
--

DROP TABLE IF EXISTS `directorates`;
CREATE TABLE IF NOT EXISTS `directorates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `director_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `director_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `directorates`
--

INSERT INTO `directorates` (`id`, `name`, `slug`, `department_id`, `description`, `message`, `photo`, `director_name`, `director_photo`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Innovation and Technology Capacity Building and Training Directorate', 'innovation-and-technology-capacity-building-and-training-directorate', 1, 'The Directorate of Software and Platform Development is in charge of creating an architectural framework for the entire city and software that adheres to international standards, conducting and analyzing feasibility analyses for software development, choosing appropriate technologies, and creating system designs for various software systems, portals/websites, databases/data warehouses, and mobile applications; development of e-learning; platform for geographic information systems; It is in the spotlight for creating open data portals, digitizing e-government data, and integrating the systems that have been created.', 'The Directorate of Software and Platform Development is in charge of creating an architectural framework for the entire city and software that adheres to international standards, conducting and analyzing feasibility analyses for software development, choosing appropriate technologies, and creating system designs for various software systems, portals/websites, databases/data warehouses, and mobile applications; development of e-learning; platform for geographic information systems; It is in the spotlight for creating open data portals, digitizing e-government data, and integrating the systems that have been created.', NULL, 'Dr Tulu Tilahun', 'dr-tulu-tilahun-2023-08-29-64ee5ce1be241.jpg', '2023-08-29 18:02:25', '2023-09-01 04:56:20', 1),
(2, 'Innovation and Technology Capacity ', 'innovation-and-technology-capacity-building-and-training-directorate', 1, 'The Directorate of Software and Platform Development is in charge of creating an architectural framework for the entire city and software that adheres to international standards, conducting and analyzing feasibility analyses for software development, choosing appropriate technologies, and creating system designs for various software systems, portals/websites, databases/data warehouses, and mobile applications; development of e-learning; platform for geographic information systems; It is in the spotlight for creating open data portals, digitizing e-government data, and integrating the systems that have been created.', 'The Directorate of Software and Platform Development is in charge of creating an architectural framework for the entire city and software that adheres to international standards, conducting and analyzing feasibility analyses for software development, choosing appropriate technologies, and creating system designs for various software systems, portals/websites, databases/data warehouses, and mobile applications; development of e-learning; platform for geographic information systems; It is in the spotlight for creating open data portals, digitizing e-government data, and integrating the systems that have been created.', NULL, 'Dr Tulu Tilahun', 'dr-tulu-tilahun-2023-08-29-64ee5ce1be241.jpg', '2023-08-29 18:02:25', '2023-09-01 04:56:20', 1),
(3, 'beruk fekade smart', 'beruk-fekade-smart', 4, 'bkfekade@gmail.com', 'bkfekade@gmail.com', NULL, 'beruk', 'beruk-fekade-smart-2023-09-03-64f44bc48ad13.png', '2023-09-03 05:38:54', '2023-09-03 06:03:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `venue_location` longtext COLLATE utf8mb4_unicode_ci,
  `venue_name` longtext COLLATE utf8mb4_unicode_ci,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `organiser_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_images` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `slug`, `event_category_id`, `description`, `venue_location`, `venue_name`, `start_date`, `end_date`, `organiser_name`, `event_images`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `status`) VALUES
(1, 'Event Name: TechXpo Addis 2023 - Unleashing Innovation for a Smart Addis Ababa', 'event-name-techxpo-addis-2023-unleashing-innovation-for-a-smart-addis-ababa', '2', '<p>value=&quot;</p>\r\n\r\n<p>Join us at the most anticipated tech event of the year, TechXpo Addis 2023, as we delve into the realm of innovation and technology, reimagining the future of Addis Ababa. Organized by the Addis Ababa City Innovation and Technology Development Bureau, this three-day extravaganza promises to be a melting pot of ideas, creativity, and groundbreaking solutions that will shape the city&#39;s digital landscape.</p>\r\n\r\n<p><strong>Event Highlights:</strong></p>\r\n\r\n<p><strong>1. Cutting-Edge Exhibitions:</strong> Explore a vast array of innovative technologies, prototypes, and solutions showcased by local and international tech companies. From smart city initiatives to sustainable energy solutions, witness the latest advancements that are set to revolutionize Addis Ababa.</p>\r\n\r\n<p><strong>2. Expert Keynote Speakers:</strong> Be inspired by visionary leaders and tech pioneers who have reshaped industries through their innovative thinking. Gain insights into emerging trends, disruptive technologies, and strategies for driving growth in the digital age.</p>\r\n\r\n<p><strong>3. Interactive Workshops:</strong> Participate in hands-on workshops led by industry experts. Learn about coding, artificial intelligence, blockchain, and more. These workshops offer a unique opportunity to dive deep into the world of tech and gain practical skills.</p>\r\n\r\n<p><strong>4. Startup Pitch Competitions:</strong> Witness the energy and passion of local startups as they compete in pitch battles. A panel of judges, including investors and tech experts, will evaluate these budding entrepreneurs who are bringing fresh ideas to the city&#39;s tech ecosystem.</p>\r\n\r\n<p><strong>5. Networking Opportunities:</strong> Connect with like-minded individuals, tech enthusiasts, entrepreneurs, and industry leaders. Forge valuable relationships that can foster collaborations and propel your innovative ideas forward.</p>\r\n\r\n<p><strong>6. City Transformation Panel:</strong> Engage in thought-provoking discussions about the role of technology in transforming Addis Ababa into a smart city. Hear from urban planners, policymakers, and tech experts about how innovation can address urban challenges and improve quality of life.</p>\r\n\r\n<p>&quot;</p>', 'Millennium Hall', NULL, '2023-08-31 00:00:00', '2023-09-01 00:00:00', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB)', '[\"64eb2221b23e4.347424804_795110452187265_5182630964312351441_n.jpg\",\"64eb2221b841e.347426108_1300661913865145_7838095004869018098_n.jpg\",\"64eb2221b8ce8.347444746_652325210258813_7552342288489497562_n.jpg\"]', '2023-08-27 07:04:34', '2023-08-27 07:11:41', NULL, 1, 1),
(2, 'TechConnect Addis: Igniting Innovation for a Smart Future', 'techconnect-addis-igniting-innovation-for-a-smart-future', '1', '<p><strong>Event Overview:</strong></p>\r\n\r\n<p>&quot;TechConnect Addis&quot; is a groundbreaking two-day event hosted by the Addis Ababa City Innovation and Technology Development Bureau (ITDB). This event serves as a platform for bringing together tech enthusiasts, innovators, industry experts, government officials, and the community to explore the transformative power of technology in shaping the city&#39;s future.</p>\r\n\r\n<p><strong>Day 1: TechExpo and Innovation Showcase</strong></p>\r\n\r\n<p>The event kicks off on October 15 with an exciting TechExpo that features the latest advancements in various fields of technology. From cutting-edge startups to established tech giants, participants can interact with innovative products, services, and solutions that are changing the way we live and work. It&#39;s an opportunity to witness firsthand the impact of technology on different aspects of life, from education and healthcare to transportation and sustainability.</p>\r\n\r\n<p>The Innovation Showcase, running parallel to the TechExpo, highlights homegrown talents and their contributions to the city&#39;s technological landscape. Attendees will be inspired by local startups and inventors who are pushing boundaries and demonstrating how innovation can create positive change within the community.</p>\r\n\r\n<p><strong>Day 2: TechTalks and Smart City Symposium</strong></p>\r\n\r\n<p>The second day of the event, October 16, shifts the focus to insightful TechTalks and a Smart City Symposium. Renowned experts, industry leaders, and thought influencers will take the stage to share their experiences and visions for a tech-driven future. Attendees can expect engaging discussions on topics like sustainable urban development, digital inclusion, cybersecurity, and the role of AI in shaping the city&#39;s landscape.</p>\r\n\r\n<p>The Smart City Symposium brings together government officials, urban planners, and technology experts to explore strategies for making Addis Ababa a smarter and more connected city. Discussions will revolve around leveraging technology to improve service delivery, enhance citizen engagement, and address urban challenges while ensuring sustainability and inclusivity.</p>\r\n\r\n<p><strong>Networking Opportunities and Workshops:</strong></p>\r\n\r\n<p>Throughout the event, attendees will have ample opportunities to connect with like-minded individuals, potential collaborators, and industry experts. Interactive workshops will provide practical insights into various technological domains, offering participants a chance to deepen their understanding and skills.</p>\r\n\r\n<p><strong>Closing Ceremony and Vision Statement:</strong></p>\r\n\r\n<p>The event concludes with a closing ceremony that summarizes the key takeaways from the TechConnect Addis event. The ITDB will also present a vision statement that outlines the bureau&#39;s roadmap for harnessing innovation and technology to achieve its ambitious goals of transforming Addis Ababa into a smart, sustainable, and resilient city by 2025.</p>\r\n\r\n<p><strong>Join Us in Shaping the Future:</strong></p>\r\n\r\n<p>&quot;TechConnect Addis&quot; is more than just an event; it&#39;s a platform for dialogue, collaboration, and inspiration. Whether you&#39;re a tech enthusiast, an entrepreneur, a policymaker, or simply curious about the potential of technology, this event offers something for everyone. Join us on October 15-16, 2023, at the Addis Ababa Conference Center, and be part of the journey to make Addis Ababa a shining example of how technology can drive positive change in urban environments. Together, let&#39;s ignite innovation for a smarter future!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'Millennium Hall', NULL, '2023-08-29 00:00:00', '2023-09-01 00:00:00', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB)', '[\"64eb2221b23e4.347424804_795110452187265_5182630964312351441_n.jpg\",\"64eb2221b841e.347426108_1300661913865145_7838095004869018098_n.jpg\",\"64eb2221b8ce8.347444746_652325210258813_7552342288489497562_n.jpg\"]', '2023-08-27 07:14:57', '2023-08-27 07:14:57', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

DROP TABLE IF EXISTS `event_categories`;
CREATE TABLE IF NOT EXISTS `event_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Policy Announcements and Releases', 'policy-announcements-and-releases-2023-08-26-64ea51c24ba3c.png', '2023-08-26 16:25:54', '2023-09-01 04:39:36', NULL, 1),
(2, 'Public Consultations and Town Halls', 'public-consultations-and-town-halls-2023-08-26-64ea51f455a06.png', '2023-08-26 16:26:44', '2023-08-26 16:26:44', NULL, 1),
(3, 'Infrastructure and Development Projects', 'infrastructure-and-development-projects-2023-08-26-64ea520b7cc74.png', '2023-08-26 16:27:07', '2023-08-26 16:27:07', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `answer` longtext COLLATE utf8mb4_unicode_ci,
  `question` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `answer`, `question`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `status`) VALUES
(1, 'The ITDB is a government organization established in April 2009 GC with a mission to develop and implement information technology solutions to enhance service delivery, research, and technological innovation in Addis Ababa.', 'What is the Addis Ababa City Innovation and Technology Development Bureau (ITDB)?', '2023-08-26 04:25:06', '2023-08-26 04:25:06', NULL, 1, 1),
(2, 'The ITDB started as an agency and later gained bureau status through restructuring in September 2019 GC, focusing on leveraging technology to transform the city and streamline service delivery.', 'How did the ITDB evolve over the years?', '2023-08-26 04:25:06', '2023-08-26 04:25:06', NULL, 1, 1),
(3, 'The recent reorganization aims to enhance service delivery, address resident concerns, and make the city smarter through technology-enabled solutions, as outlined in Proclamation No. 74/2015.', 'What is the purpose of the recent reorganization of the ITDB?', '2023-08-26 04:25:06', '2023-08-26 04:25:06', NULL, 1, 1),
(4, 'The ITDB is responsible for conducting research to improve existing technology, developing new technology, establishing information systems, and ensuring the quality and reliability of IT infrastructure in the city.', 'What are the primary tasks of the ITDB?', '2023-08-26 04:25:06', '2023-08-26 04:25:06', NULL, 1, 1),
(5, 'The ITDB supports the city administration by implementing ICT solutions, conducting policy analysis, and promoting strategic thinking to drive economic growth and improve citizens\' lives.', 'How does the ITDB contribute to Addis Ababa\'s growth?', '2023-08-26 04:25:06', '2023-08-26 04:25:06', NULL, 1, 1),
(6, 'The vision is to implement major IT technologies by 2025, creating a sustainable and resilient city that offers convenience and benefits to residents and visitors alike.', 'What is the vision of the ITDB for the future?', '2023-08-26 04:25:06', '2023-08-26 04:25:06', NULL, 1, 1),
(7, 'The ITDB values include availability, affordability, accessibility, sustainability, resilience, advocating technologies, economic thriving, environmental friendliness, health and safety, and quality of life improvement.', 'What values does the ITDB uphold?', '2023-08-26 04:25:06', '2023-08-26 04:25:06', NULL, 1, 1),
(8, 'The ITDB monitors and supports developed IT infrastructures, optimizes existing systems, and ensures standards compliance to address political, social, and economic challenges.', 'How does the ITDB contribute to service optimization?', '2023-08-26 04:25:06', '2023-08-26 04:25:06', NULL, 1, 1),
(9, 'Research is essential for improving existing technology, developing new solutions, and enhancing information technology infrastructures that benefit residents and visitors.', 'What role does research play in the ITDB\'s activities?', '2023-08-26 04:25:06', '2023-08-26 04:25:06', NULL, 1, 1),
(10, 'The ITDB aligns with the city\'s objectives by leveraging technology to accelerate economic growth, deliver better public services, and create positive changes in the lives of citizens.', 'How does the ITDB align with the city\'s goals?', '2023-08-26 04:25:06', '2023-08-26 04:25:06', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `image`, `gallery_category_id`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, NULL, '\"1693143122377347385086_3640238176256747_2634138641458688203_n.jpg\"', NULL, '2022-08-27 10:32:03', '2022-08-27 10:32:03', NULL, 1),
(2, NULL, '\"1693143122379347387878_1238966506746985_285328486412111298_n.jpg\"', NULL, '2023-08-27 10:32:03', '2023-08-27 10:32:03', NULL, 1),
(3, NULL, '\"1693143122380347389824_3036073496524822_1035794266220386046_n.jpg\"', NULL, '2023-08-27 10:32:03', '2023-08-27 10:32:03', NULL, 1),
(4, NULL, '\"1693143122382347390561_1321991318385729_4252976463739251066_n.jpg\"', NULL, '2023-08-27 10:32:04', '2023-08-27 10:32:04', NULL, 1),
(5, NULL, '\"1693143122384347401483_739764077926128_7326413578487071425_n.jpg\"', NULL, '2023-08-27 10:32:04', '2023-08-27 10:32:04', NULL, 1),
(6, NULL, '\"1693143122385347404701_576921097763428_4939849357709865241_n.jpg\"', NULL, '2023-08-27 10:32:04', '2023-08-27 10:32:04', NULL, 1),
(7, NULL, '\"1693143122386347406009_747498160432015_35022147806480699_n.jpg\"', NULL, '2023-08-27 10:32:05', '2023-08-27 10:32:05', NULL, 1),
(8, NULL, '\"1693143122387347238795_908063036919994_1392111367283669202_n.jpg\"', NULL, '2023-08-27 10:32:05', '2023-08-27 10:32:05', NULL, 1),
(9, NULL, '\"1693143122388347244628_1495521981192286_1388502505692377259_n.jpg\"', NULL, '2023-08-27 10:32:05', '2023-08-27 10:32:05', NULL, 1),
(10, NULL, '\"1693143122389347249927_787459062758230_5932840558773751503_n.jpg\"', NULL, '2023-08-27 10:32:05', '2023-08-27 10:32:05', NULL, 1),
(11, NULL, '\"1693143122390347254547_259100756642847_3254800390854396393_n.jpg\"', NULL, '2023-08-27 10:32:06', '2023-08-27 10:32:06', NULL, 1),
(12, NULL, '\"1693143122391347255525_1292978441618216_1853616677533419468_n.jpg\"', NULL, '2023-08-27 10:32:06', '2023-08-27 10:32:06', NULL, 1),
(13, NULL, '\"1693143122392347261525_221842960653494_3562755169909784677_n (1).jpg\"', NULL, '2023-08-27 10:32:06', '2023-08-27 10:32:06', NULL, 1),
(14, NULL, '\"1693143122393347261525_221842960653494_3562755169909784677_n.jpg\"', NULL, '2023-08-27 10:32:07', '2023-08-27 10:32:07', NULL, 1),
(15, NULL, '\"1693143122394347268365_639034738077560_7501764490783264926_n.jpg\"', NULL, '2023-08-27 10:32:07', '2023-08-27 10:32:07', NULL, 1),
(16, NULL, '\"1693143122395347284977_1415334539253004_4867594280009884796_n.jpg\"', NULL, '2023-08-27 10:32:07', '2023-08-27 10:32:07', NULL, 1),
(17, NULL, '\"1693398011335347426108_1300661913865145_7838095004869018098_n.jpg\"', NULL, '2023-08-30 09:20:11', '2023-08-30 09:20:11', NULL, 1),
(18, NULL, '\"1693398011334347255525_1292978441618216_1853616677533419468_n.jpg\"', NULL, '2023-08-30 09:20:12', '2023-08-30 09:20:12', NULL, 1),
(19, NULL, '\"1693398011336347238795_908063036919994_1392111367283669202_n.jpg\"', NULL, '2023-08-30 09:20:12', '2023-08-30 09:20:12', NULL, 1),
(20, NULL, '\"1693398011336347284977_1415334539253004_4867594280009884796_n.jpg\"', NULL, '2023-08-30 09:20:12', '2023-08-30 09:20:12', NULL, 1),
(21, NULL, '\"1693398011337347244628_1495521981192286_1388502505692377259_n.jpg\"', NULL, '2023-08-30 09:20:13', '2023-08-30 09:20:13', NULL, 1),
(22, NULL, '\"1693398011337347254547_259100756642847_3254800390854396393_n.jpg\"', NULL, '2023-08-30 09:20:13', '2023-08-30 09:20:13', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_categories`
--

DROP TABLE IF EXISTS `gallery_categories`;
CREATE TABLE IF NOT EXISTS `gallery_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `head_messages`
--

DROP TABLE IF EXISTS `head_messages`;
CREATE TABLE IF NOT EXISTS `head_messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` longtext COLLATE utf8mb4_unicode_ci,
  `full_name_am` longtext COLLATE utf8mb4_unicode_ci,
  `full_name_or` longtext COLLATE utf8mb4_unicode_ci,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `message_am` longtext COLLATE utf8mb4_unicode_ci,
  `message_or` longtext COLLATE utf8mb4_unicode_ci,
  `intro` longtext COLLATE utf8mb4_unicode_ci,
  `intro_am` longtext COLLATE utf8mb4_unicode_ci,
  `intro_or` longtext COLLATE utf8mb4_unicode_ci,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `head_messages`
--

INSERT INTO `head_messages` (`id`, `full_name`, `full_name_am`, `full_name_or`, `message`, `message_am`, `message_or`, `intro`, `intro_am`, `intro_or`, `photo`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Ato Selomon Amare', 'አቶ ሰሎሞን አማረ', 'Obbo Sooloomoon Aamaare', 'The Innovation and Technology Development Office of Addis Ababa City Administration is an office established in accordance with Proclamation Amendment No. 79/2015. In the decree, more than 21 powers and duties have been given to him. The main objective of the office is to make the procedures of institutions modern and efficient. To achieve this, the organizational system and human resources are being completed and developed. Accordingly, the office is organized into three main areas. They are the innovation and technology development sector; They are Innovation and Technology Operation Service Sector and Smart City Sector.', 'የአዲስ አበባ ከተማ አስተዳደር የኢኖቬሽንና ቴክኖሎጂ ልማት ቢሮ በአዋጅ ማሻሻያ ቁጥር 79/2015 መሰረት የተቋቋመ ቢሮ ነው፡፡ በአዋጁም ከ21 በላይ የሚሆኑ ስልጣንና ተግባራት ተሰጥተውታል፡፡ የቢሮው ዋና አላማ የተቋማትን አሰራሮች ዘመናዊና ቀልጣፋ ማድረግ ነው፡፡ ይህንን ለማሳካት የሚያስችል አደረጃጀት አሰራርና የሰው ሀይል በሟሟላትና በመዘርጋት ላይ ነው፡፡ በዚህም ቢሮው በሶስት ዋና ዋና ዘርፎች ተደራጅቷል፡፡ እነሱም የኢኖቬሽንና ቴክኖሎጂ ልማት ዘርፍ፤ የኢኖቬሽንና ቴክኖሎጂ ኦፕሬሽን አገልግሎት ዘርፍ እና የስማርት ሲቲ ዘርፍ ናቸው፡፡ \r\nበዚህም መነሻ የቢሮው አሰራር ወሳኝ ቴክኖሎጂዎችን ተግባራዊ በማድረግ ለነዋሪዎቿ እና ለጎብኚዎቿ ምቹ የሆነች፤ ዘላቂ እና ችግሮችን መቋቋም የምትችል አዲስ አበባን በመፍጠር ህብረተሰቡ በአነስተኛ ወጪና ባጠረ ጊዜ አገልግሎት የሚያገኝበት ዘመናዊ ህይወት መኖር የሚቻልበትን መንገድ መፍጠር ነው።', 'Waajjirri Misooma Innooveeshinii fi Teeknooloojii Bulchiinsa Magaalaa Addis Ababa akkaataa Fooyya’iinsa Labsii Lakk. Labsii kanaan aangoo fi dirqamni 21 ol kennameefii jira. Kaayyoon waajjirichaa inni guddaan hojimaata dhaabbilee ammayyaa fi gahumsa qabu taasisuudha. Kana milkeessuuf sirna jaarmiyaa fi humna namaa xumuramee misoomsaa jira. Haaluma kanaan waajjirri kun naannoolee gurguddoo sadiitti gurmaa\'ee jira. Isaanis damee kalaqaa fi misooma teeknooloojii; Isaanis Damee Tajaajila Hojii Kalaqaa fi Teeknooloojii fi Damee Magaalaa Ismaartii dha.', 'Message from the head of the office', 'የቢሮው ኃላፊ መልዕክት', 'Dhaamsa itti gaafatamaa waajjirichaa', 'ato-selomon-amare-2023-08-29-64ee4393b0d1a.jpg', '2023-08-29 15:54:12', '2023-08-29 16:14:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

DROP TABLE IF EXISTS `histories`;
CREATE TABLE IF NOT EXISTS `histories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `title`, `year`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Establishment', '2009', '<p>April 2009 GC: The ITDB was originally established as an agency under Proclamation No. 11/2009. During this time, its primary focus was on technology and vocational training.</p>', 'establishment-2023-09-01-64f1e1b1723ce.jpg', '2023-09-01 10:05:53', '2023-09-01 10:05:53'),
(2, 'Transformation', '2019', '<p>September 2019 GC: The ITDB underwent a significant transformation as part of the restructuring of the city&#39;s executive bodies. It transitioned from being an agency to acquiring a bureau structure, signaling a more substantial role in the city&#39;s governance.</p>', 'transformation-2023-09-01-64f1e1d05628a.jpg', '2023-09-01 10:06:24', '2023-09-01 10:06:24'),
(3, '3rd phase', '2022', '<p>The ITDB went into its 3rd phase of re-institution by Proclamation No. 74/2015. This marked another crucial milestone in its evolution.</p>', '3rd-phase-2023-09-01-64f1e1ec8f5b8.jpg', '2023-09-01 10:06:52', '2023-09-01 10:06:52'),
(4, 'Present Day', '2023', '<ol>\r\n	<li>\r\n	<p>Present Day: The newly established ITDB office is organized to address service delivery challenges faced by residents and transform the city&#39;s image. Its main objectives include leveraging technology for service delivery, carrying out responsibilities mandated by decrees, and focusing on making the city smart with technology.</p>\r\n	</li>\r\n	<li>\r\n	<p>Ongoing Activities: The ITDB carries out various tasks, including conducting research to improve existing technology and develop new technology. It also focuses on developing information systems and ICT infrastructure, ensuring standards, quality, safety, and reliability of IT systems in the city, monitoring and supporting IT infrastructures, and optimizing existing systems to address political, social, and economic challenges.</p>\r\n	</li>\r\n	<li>\r\n	<p>Vision: The ITDB&#39;s vision is to implement major IT technologies that benefit the residents and visitors of Addis Ababa by 2025. This vision aims to make Addis Ababa a sustainable and resilient city.</p>\r\n	</li>\r\n	<li>\r\n	<p>Mission: The mission of the ITDB is to ensure the benefit of residents and visitors by implementing IT infrastructures supported by research, enhancing secure systems, and expanding digital services.</p>\r\n	</li>\r\n	<li>\r\n	<p>Values: The ITDB operates based on a set of values that include availability, affordability, accessibility, sustainability, resilience, advocacy for technologies, economic growth, environmental friendliness, health and safety, and improving the quality of life for citizens.</p>\r\n	</li>\r\n</ol>\r\n\r\n<p>This chronological flow outlines the key milestones and objectives of the Addis Ababa City Innovation and Technology Development Bureau from its inception to the present day.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'present-day-2023-09-01-64f1e219835e9.jpg', '2023-09-01 10:07:37', '2023-09-01 10:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `action`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'A New Banner Created', 1, '2023-08-26 04:18:24', '2023-08-26 04:18:24', NULL, 1),
(2, 'A new  car category created', 1, '2023-08-26 04:44:10', '2023-08-26 04:44:10', NULL, 1),
(3, 'A new  car category created', 1, '2023-08-26 04:48:31', '2023-08-26 04:48:31', NULL, 1),
(4, 'A new  car category created', 1, '2023-08-26 04:48:46', '2023-08-26 04:48:46', NULL, 1),
(5, 'A new  car category created', 1, '2023-08-26 04:49:03', '2023-08-26 04:49:03', NULL, 1),
(6, 'A new  car category created', 1, '2023-08-26 04:49:16', '2023-08-26 04:49:16', NULL, 1),
(7, 'A new  car category created', 1, '2023-08-26 04:49:34', '2023-08-26 04:49:34', NULL, 1),
(8, 'A new  car category created', 1, '2023-08-26 04:51:14', '2023-08-26 04:51:14', NULL, 1),
(9, 'A New Blog Created', 1, '2023-08-26 05:42:25', '2023-08-26 05:42:25', NULL, 1),
(10, 'A blog information updated', 1, '2023-08-26 06:02:39', '2023-08-26 06:02:39', NULL, 1),
(11, 'General site setting changed', 1, '2023-08-26 11:31:41', '2023-08-26 11:31:41', NULL, 1),
(12, 'Site setting changed', 1, '2023-08-26 11:35:41', '2023-08-26 11:35:41', NULL, 1),
(13, 'Site setting changed', 1, '2023-08-26 11:37:23', '2023-08-26 11:37:23', NULL, 1),
(14, 'Site setting changed', 1, '2023-08-26 11:38:00', '2023-08-26 11:38:00', NULL, 1),
(15, 'Site setting changed', 1, '2023-08-26 11:45:39', '2023-08-26 11:45:39', NULL, 1),
(16, 'Site setting changed', 1, '2023-08-26 11:47:39', '2023-08-26 11:47:39', NULL, 1),
(17, 'A New Testimony Created', 1, '2023-08-26 11:54:22', '2023-08-26 11:54:22', NULL, 1),
(18, 'A New Partner Created', 1, '2023-08-26 11:58:37', '2023-08-26 11:58:37', NULL, 1),
(19, 'A new event category created', 1, '2023-08-26 16:25:54', '2023-08-26 16:25:54', NULL, 1),
(20, 'A new event category created', 1, '2023-08-26 16:26:44', '2023-08-26 16:26:44', NULL, 1),
(21, 'A new event category created', 1, '2023-08-26 16:27:07', '2023-08-26 16:27:07', NULL, 1),
(22, 'A New Event Created', 1, '2023-08-27 06:51:01', '2023-08-27 06:51:01', NULL, 1),
(23, 'A New Event Created', 1, '2023-08-27 07:04:34', '2023-08-27 07:04:34', NULL, 1),
(24, 'An event information updated', 1, '2023-08-27 07:11:41', '2023-08-27 07:11:41', NULL, 1),
(25, 'A New Event Created', 1, '2023-08-27 07:14:57', '2023-08-27 07:14:57', NULL, 1),
(26, 'A New Department Created', 1, '2023-08-27 11:33:48', '2023-08-27 11:33:48', NULL, 1),
(27, 'A Department updated', 1, '2023-08-27 12:01:52', '2023-08-27 12:01:52', NULL, 1),
(28, 'A new event category created', 1, '2023-08-28 08:01:32', '2023-08-28 08:01:32', NULL, 1),
(29, 'A new event category created', 1, '2023-08-28 08:03:08', '2023-08-28 08:03:08', NULL, 1),
(30, 'A new event category created', 1, '2023-08-28 08:03:30', '2023-08-28 08:03:30', NULL, 1),
(31, 'A new event category created', 1, '2023-08-28 08:03:46', '2023-08-28 08:03:46', NULL, 1),
(32, 'A new event category created', 1, '2023-08-28 08:04:34', '2023-08-28 08:04:34', NULL, 1),
(33, 'A New Publication Created', 1, '2023-08-28 08:14:55', '2023-08-28 08:14:55', NULL, 1),
(34, 'A publication information updated', 1, '2023-08-28 09:01:10', '2023-08-28 09:01:10', NULL, 1),
(35, 'A New Department Created', 1, '2023-08-28 13:09:25', '2023-08-28 13:09:25', NULL, 1),
(36, 'A New Department Created', 1, '2023-08-29 03:48:39', '2023-08-29 03:48:39', NULL, 1),
(37, 'A New Department Created', 1, '2023-08-29 04:30:05', '2023-08-29 04:30:05', NULL, 1),
(38, 'A New Department Created', 1, '2023-08-29 04:32:35', '2023-08-29 04:32:35', NULL, 1),
(39, 'A Department updated', 1, '2023-08-29 04:37:52', '2023-08-29 04:37:52', NULL, 1),
(40, 'A Department updated', 1, '2023-08-29 04:39:58', '2023-08-29 04:39:58', NULL, 1),
(41, 'Site setting changed', 1, '2023-08-29 08:44:33', '2023-08-29 08:44:33', NULL, 1),
(42, 'Amharic setting changed', 1, '2023-08-29 08:45:28', '2023-08-29 08:45:28', NULL, 1),
(43, 'Site setting changed', 1, '2023-08-29 09:01:25', '2023-08-29 09:01:25', NULL, 1),
(44, 'General site setting changed', 1, '2023-08-29 09:26:55', '2023-08-29 09:26:55', NULL, 1),
(45, 'Contact setting changed', 1, '2023-08-29 09:34:48', '2023-08-29 09:34:48', NULL, 1),
(46, 'Amharic setting changed', 1, '2023-08-29 09:35:57', '2023-08-29 09:35:57', NULL, 1),
(47, 'Site setting changed', 1, '2023-08-29 09:36:48', '2023-08-29 09:36:48', NULL, 1),
(48, 'Amharic setting changed', 1, '2023-08-29 09:36:59', '2023-08-29 09:36:59', NULL, 1),
(49, 'Site setting changed', 1, '2023-08-29 09:37:59', '2023-08-29 09:37:59', NULL, 1),
(50, 'General site setting changed', 1, '2023-08-29 09:47:50', '2023-08-29 09:47:50', NULL, 1),
(51, 'General site setting changed', 1, '2023-08-29 09:49:43', '2023-08-29 09:49:43', NULL, 1),
(52, 'Head Information changed', 1, '2023-08-29 15:54:20', '2023-08-29 15:54:20', NULL, 1),
(53, 'Head Information changed', 1, '2023-08-29 16:06:14', '2023-08-29 16:06:14', NULL, 1),
(54, 'Head Information changed', 1, '2023-08-29 16:13:20', '2023-08-29 16:13:20', NULL, 1),
(55, 'Head Information changed', 1, '2023-08-29 16:14:27', '2023-08-29 16:14:27', NULL, 1),
(56, 'A New Department Created', 1, '2023-08-29 17:34:51', '2023-08-29 17:34:51', NULL, 1),
(57, 'A New Department Created', 1, '2023-08-29 17:36:38', '2023-08-29 17:36:38', NULL, 1),
(58, 'A New Department Created', 1, '2023-08-29 17:37:45', '2023-08-29 17:37:45', NULL, 1),
(59, 'A New Department Created', 1, '2023-08-29 17:38:26', '2023-08-29 17:38:26', NULL, 1),
(60, 'A New Directorate Created', 1, '2023-08-29 18:02:25', '2023-08-29 18:02:25', NULL, 1),
(61, 'A Directorate updated', 1, '2023-08-30 01:10:24', '2023-08-30 01:10:24', NULL, 1),
(62, 'A New Banner Created', 1, '2023-08-30 02:26:08', '2023-08-30 02:26:08', NULL, 1),
(63, 'A banner deleted', 1, '2023-08-30 02:27:45', '2023-08-30 02:27:45', NULL, 1),
(64, 'A New Banner Created', 1, '2023-08-30 02:28:13', '2023-08-30 02:28:13', NULL, 1),
(65, 'A banner deleted', 1, '2023-08-30 02:28:56', '2023-08-30 02:28:56', NULL, 1),
(66, 'A New Banner Created', 1, '2023-08-30 02:29:20', '2023-08-30 02:29:20', NULL, 1),
(67, 'A New Partner Created', 1, '2023-08-30 05:46:50', '2023-08-30 05:46:50', NULL, 1),
(68, 'A New Partner Created', 1, '2023-08-30 05:47:29', '2023-08-30 05:47:29', NULL, 1),
(69, 'A New Partner Created', 1, '2023-08-30 05:48:27', '2023-08-30 05:48:27', NULL, 1),
(70, 'A New Partner Created', 1, '2023-08-30 05:49:17', '2023-08-30 05:49:17', NULL, 1),
(71, 'Site setting changed', 1, '2023-08-30 06:19:17', '2023-08-30 06:19:17', NULL, 1),
(72, 'Amharic setting changed', 1, '2023-08-30 06:21:02', '2023-08-30 06:21:02', NULL, 1),
(73, 'Site setting changed', 1, '2023-08-30 06:23:55', '2023-08-30 06:23:55', NULL, 1),
(74, 'Site setting changed', 1, '2023-08-30 06:25:27', '2023-08-30 06:25:27', NULL, 1),
(75, 'A new user created', 1, '2023-08-30 06:50:48', '2023-08-30 06:50:48', NULL, 1),
(76, 'A New Blog Created', 2, '2023-08-30 07:25:11', '2023-08-30 07:25:11', NULL, 1),
(77, 'A Department updated', 2, '2023-08-30 08:51:03', '2023-08-30 08:51:03', NULL, 1),
(78, 'A new user created', 2, '2023-08-30 09:16:02', '2023-08-30 09:16:02', NULL, 1),
(79, 'A gallery added', 2, '2023-08-30 09:20:11', '2023-08-30 09:20:11', NULL, 1),
(80, 'A gallery added', 2, '2023-08-30 09:20:12', '2023-08-30 09:20:12', NULL, 1),
(81, 'A gallery added', 2, '2023-08-30 09:20:12', '2023-08-30 09:20:12', NULL, 1),
(82, 'A gallery added', 2, '2023-08-30 09:20:12', '2023-08-30 09:20:12', NULL, 1),
(83, 'A gallery added', 2, '2023-08-30 09:20:13', '2023-08-30 09:20:13', NULL, 1),
(84, 'A gallery added', 2, '2023-08-30 09:20:13', '2023-08-30 09:20:13', NULL, 1),
(85, 'A New Department Created', 2, '2023-08-30 09:23:51', '2023-08-30 09:23:51', NULL, 1),
(86, 'A New Banner Created', 2, '2023-08-30 09:31:47', '2023-08-30 09:31:47', NULL, 1),
(87, 'A Banner activated / deactivated', 1, '2023-08-31 13:58:51', '2023-08-31 13:58:51', NULL, 1),
(88, 'A Banner activated / deactivated', 1, '2023-08-31 14:16:14', '2023-08-31 14:16:14', NULL, 1),
(89, 'A Banner activated / deactivated', 1, '2023-08-31 14:19:59', '2023-08-31 14:19:59', NULL, 1),
(90, 'A Banner activated / deactivated', 1, '2023-08-31 14:21:30', '2023-08-31 14:21:30', NULL, 1),
(91, 'A Banner activated / deactivated', 1, '2023-08-31 14:22:23', '2023-08-31 14:22:23', NULL, 1),
(92, 'A Banner activated / deactivated', 1, '2023-08-31 14:54:14', '2023-08-31 14:54:14', NULL, 1),
(93, 'A BlogCategory activated / deactivated', 1, '2023-08-31 14:55:13', '2023-08-31 14:55:13', NULL, 1),
(94, 'An Event Category activated / deactivated', 1, '2023-09-01 04:39:15', '2023-09-01 04:39:15', NULL, 1),
(95, 'An Event Category activated / deactivated', 1, '2023-09-01 04:39:26', '2023-09-01 04:39:26', NULL, 1),
(96, 'An Event Category activated / deactivated', 1, '2023-09-01 04:39:32', '2023-09-01 04:39:32', NULL, 1),
(97, 'An Event Category activated / deactivated', 1, '2023-09-01 04:39:36', '2023-09-01 04:39:36', NULL, 1),
(98, 'A Publication Category activated / deactivated', 1, '2023-09-01 04:43:11', '2023-09-01 04:43:11', NULL, 1),
(99, 'A Department activated / deactivated', 1, '2023-09-01 04:50:09', '2023-09-01 04:50:09', NULL, 1),
(100, 'A Department activated / deactivated', 1, '2023-09-01 04:50:14', '2023-09-01 04:50:14', NULL, 1),
(101, 'A Department activated / deactivated', 1, '2023-09-01 04:53:33', '2023-09-01 04:53:33', NULL, 1),
(102, 'A Department activated / deactivated', 1, '2023-09-01 04:53:38', '2023-09-01 04:53:38', NULL, 1),
(103, 'A Directorate activated / deactivated', 1, '2023-09-01 04:55:38', '2023-09-01 04:55:38', NULL, 1),
(104, 'A Directorate activated / deactivated', 1, '2023-09-01 04:56:20', '2023-09-01 04:56:20', NULL, 1),
(105, 'A Department activated / deactivated', 1, '2023-09-01 04:57:24', '2023-09-01 04:57:24', NULL, 1),
(106, 'A Service activated / deactivated', 1, '2023-09-01 06:02:38', '2023-09-01 06:02:38', NULL, 1),
(107, 'A New Service Created', 1, '2023-09-01 07:24:37', '2023-09-01 07:24:37', NULL, 1),
(108, 'A Service activated / deactivated', 1, '2023-09-01 07:24:43', '2023-09-01 07:24:43', NULL, 1),
(109, 'A New History Created', 1, '2023-09-01 09:52:45', '2023-09-01 09:52:45', NULL, 1),
(110, 'A New History Created', 1, '2023-09-01 09:53:23', '2023-09-01 09:53:23', NULL, 1),
(111, 'A New History Created', 1, '2023-09-01 09:54:02', '2023-09-01 09:54:02', NULL, 1),
(112, 'A New History Created', 1, '2023-09-01 09:54:23', '2023-09-01 09:54:23', NULL, 1),
(113, 'A New History Created', 1, '2023-09-01 10:05:53', '2023-09-01 10:05:53', NULL, 1),
(114, 'A New History Created', 1, '2023-09-01 10:06:24', '2023-09-01 10:06:24', NULL, 1),
(115, 'A New History Created', 1, '2023-09-01 10:06:52', '2023-09-01 10:06:52', NULL, 1),
(116, 'A New History Created', 1, '2023-09-01 10:07:37', '2023-09-01 10:07:37', NULL, 1),
(117, 'A New Directorate Created', 1, '2023-09-03 05:38:54', '2023-09-03 05:38:54', NULL, 1),
(118, 'A Directorate updated', 1, '2023-09-03 06:03:00', '2023-09-03 06:03:00', NULL, 1),
(119, 'A new user created', 8, '2023-09-03 18:03:24', '2023-09-03 18:03:24', NULL, 1),
(120, 'A Banner activated / deactivated', 8, '2023-09-04 03:27:25', '2023-09-04 03:27:25', NULL, 1),
(121, 'A new user created', 8, '2023-09-04 03:35:32', '2023-09-04 03:35:32', NULL, 1),
(122, 'A new user created', 2, '2023-09-04 09:02:25', '2023-09-04 09:02:25', NULL, 1),
(123, 'A New Vacancy Created', 11, '2023-09-04 09:22:46', '2023-09-04 09:22:46', NULL, 1),
(124, 'General site setting changed', 11, '2023-09-04 15:51:01', '2023-09-04 15:51:01', NULL, 1),
(125, 'General site setting changed', 11, '2023-09-04 15:52:11', '2023-09-04 15:52:11', NULL, 1),
(126, 'General site setting changed', 11, '2023-09-04 15:56:31', '2023-09-04 15:56:31', NULL, 1),
(127, 'General site setting changed', 11, '2023-09-04 15:57:08', '2023-09-04 15:57:08', NULL, 1),
(128, 'A new user created', 11, '2023-09-05 02:23:09', '2023-09-05 02:23:09', NULL, 1),
(129, 'A New Department Created', 11, '2023-09-05 03:47:23', '2023-09-05 03:47:23', NULL, 1),
(130, 'A New Department Created', 11, '2023-09-05 03:48:22', '2023-09-05 03:48:22', NULL, 1),
(131, 'General site setting changed', 11, '2023-09-05 05:13:32', '2023-09-05 05:13:32', NULL, 1),
(132, 'General site setting changed', 11, '2023-09-05 05:14:45', '2023-09-05 05:14:45', NULL, 1),
(133, 'General site setting changed', 11, '2023-09-05 05:34:57', '2023-09-05 05:34:57', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2023_08_25_201945_create_logs_table', 2),
(4, '2023_08_25_174515_create_banners_table', 3),
(12, '2023_08_25_174527_create_settings_table', 8),
(8, '2023_08_25_174726_create_faqs_table', 5),
(10, '2023_08_25_174540_create_blog_categories_table', 6),
(11, '2023_08_25_174535_create_blogs_table', 7),
(13, '2023_08_26_145000_create_testimonies_table', 9),
(14, '2023_08_26_145545_create_partners_table', 10),
(64, '2023_08_26_150328_create_comments_table', 34),
(16, '2023_08_25_192914_create_contacts_table', 12),
(18, '2023_08_25_174553_create_event_categories_table', 13),
(20, '2023_08_25_174558_create_events_table', 14),
(21, '2023_08_25_174606_create_galleries_table', 15),
(60, '2023_08_27_135230_create_services_table', 30),
(31, '2023_08_27_134924_create_directorates_table', 23),
(33, '2023_08_25_174619_create_departments_table', 24),
(26, '2023_08_25_174709_create_publication_categories_table', 19),
(27, '2023_08_25_174704_create_publications_table', 20),
(30, '2023_08_29_174628_create_head_messages_table', 22),
(43, '2014_10_12_100000_create_password_reset_tokens_table', 26),
(44, '2014_10_12_100000_create_password_resets_table', 26),
(45, '2019_08_19_000000_create_failed_jobs_table', 26),
(46, '2019_12_14_000001_create_personal_access_tokens_table', 26),
(47, '2023_08_25_174547_create_gallery_categories_table', 26),
(48, '2023_08_25_174648_create_teams_table', 26),
(61, '2023_08_25_174654_create_histories_table', 31),
(54, '2023_08_31_121323_create_media_table', 27),
(55, '2023_08_31_121323_create_permission_tables', 27),
(57, '2023_08_31_124647_add_columns', 28),
(58, '2023_09_01_082111_add_service_icon', 29),
(62, '2023_09_03_175341_create_vacancies_table', 32),
(63, '2023_09_03_175350_create_applications_table', 33);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(4, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(4, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
CREATE TABLE IF NOT EXISTS `partners` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `link`, `image`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Addis Ababa City Administration', 'https://mahetot.com', 'addis-ababa-city-administration-2023-08-26-64ea131db0757.png', '2023-08-26 11:58:37', '2023-08-26 11:58:37', NULL, 1),
(2, 'Ethio-Telecom', 'https://mahetot.com', 'ethio-telecom-2023-08-30-64ef01fa38bfb.png', '2023-08-30 05:46:50', '2023-08-30 05:46:50', NULL, 1),
(3, 'Ethio-Telecom', 'https://mahetot.com', 'ethio-telecom-2023-08-30-64ef022188c3b.png', '2023-08-30 05:47:29', '2023-08-30 05:47:29', NULL, 1),
(4, 'Higher Education Institutions,', 'https://mahetot.com', 'higher-education-institutions-2023-08-30-64ef025bd3c89.jpg', '2023-08-30 05:48:27', '2023-08-30 05:48:27', NULL, 1),
(5, 'Ministry of Innovation and Technology', 'https://mahetot.com', 'ministry-of-innovation-and-technology-2023-08-30-64ef028d32d5c.png', '2023-08-30 05:49:17', '2023-08-30 05:49:17', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=440 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(325, 'gallerycategory_access', 'web', '2023-09-03 17:55:54', '2023-09-03 17:55:54'),
(326, 'gallerycategory_create', 'web', '2023-09-03 17:55:54', '2023-09-03 17:55:54'),
(327, 'gallerycategory_show', 'web', '2023-09-03 17:55:54', '2023-09-03 17:55:54'),
(328, 'gallerycategory_edit', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(329, 'gallerycategory_delete', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(330, 'role_create', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(331, 'role_edit', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(332, 'role_show', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(333, 'role_delete', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(334, 'role_access', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(335, 'user_create', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(336, 'user_edit', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(337, 'user_show', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(338, 'user_delete', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(339, 'user_access', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(340, 'dashboard_access', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(341, 'banner_create', 'web', '2023-09-03 17:55:55', '2023-09-03 17:55:55'),
(342, 'banner_edit', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(343, 'banner_show', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(344, 'banner_delete', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(345, 'banner_access', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(346, 'blog_create', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(347, 'blog_edit', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(348, 'blog_show', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(349, 'blog_delete', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(350, 'blog_access', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(351, 'blogcategory_access', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(352, 'blogcategory_create', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(353, 'blogcategory_show', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(354, 'blogcategory_edit', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(355, 'blogcategory_delete', 'web', '2023-09-03 17:55:56', '2023-09-03 17:55:56'),
(356, 'contact_create', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(357, 'contact_edit', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(358, 'contact_show', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(359, 'contact_delete', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(360, 'contact_access', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(361, 'sector_create', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(362, 'sector_edit', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(363, 'sector_show', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(364, 'sector_delete', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(365, 'sector_access', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(366, 'directorate_access', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(367, 'directorate_create', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(368, 'directorate_show', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(369, 'directorate_edit', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(370, 'directorate_delete', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(371, 'event_access', 'web', '2023-09-03 17:55:57', '2023-09-03 17:55:57'),
(372, 'event_create', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(373, 'event_show', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(374, 'event_edit', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(375, 'event_delete', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(376, 'eventcategory_access', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(377, 'eventcategory_create', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(378, 'eventcategory_show', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(379, 'eventcategory_edit', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(380, 'eventcategory_delete', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(381, 'faq_access', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(382, 'faq_create', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(383, 'faq_show', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(384, 'faq_edit', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(385, 'faq_delete', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(386, 'gallery_access', 'web', '2023-09-03 17:55:58', '2023-09-03 17:55:58'),
(387, 'gallery_create', 'web', '2023-09-03 17:55:59', '2023-09-03 17:55:59'),
(388, 'gallery_show', 'web', '2023-09-03 17:55:59', '2023-09-03 17:55:59'),
(389, 'gallery_edit', 'web', '2023-09-03 17:55:59', '2023-09-03 17:55:59'),
(390, 'gallery_delete', 'web', '2023-09-03 17:55:59', '2023-09-03 17:55:59'),
(391, 'setting_access', 'web', '2023-09-03 17:55:59', '2023-09-03 17:55:59'),
(392, 'setting_create', 'web', '2023-09-03 17:55:59', '2023-09-03 17:55:59'),
(393, 'setting_show', 'web', '2023-09-03 17:55:59', '2023-09-03 17:55:59'),
(394, 'setting_edit', 'web', '2023-09-03 17:55:59', '2023-09-03 17:55:59'),
(395, 'setting_delete', 'web', '2023-09-03 17:55:59', '2023-09-03 17:55:59'),
(396, 'history_access', 'web', '2023-09-03 17:55:59', '2023-09-03 17:55:59'),
(397, 'history_create', 'web', '2023-09-03 17:55:59', '2023-09-03 17:55:59'),
(398, 'history_show', 'web', '2023-09-03 17:55:59', '2023-09-03 17:55:59'),
(399, 'history_edit', 'web', '2023-09-03 17:56:00', '2023-09-03 17:56:00'),
(400, 'history_delete', 'web', '2023-09-03 17:56:00', '2023-09-03 17:56:00'),
(401, 'log_access', 'web', '2023-09-03 17:56:00', '2023-09-03 17:56:00'),
(402, 'log_create', 'web', '2023-09-03 17:56:00', '2023-09-03 17:56:00'),
(403, 'log_show', 'web', '2023-09-03 17:56:00', '2023-09-03 17:56:00'),
(404, 'log_delete', 'web', '2023-09-03 17:56:00', '2023-09-03 17:56:00'),
(405, 'partner_access', 'web', '2023-09-03 17:56:00', '2023-09-03 17:56:00'),
(406, 'partner_create', 'web', '2023-09-03 17:56:00', '2023-09-03 17:56:00'),
(407, 'partner_show', 'web', '2023-09-03 17:56:00', '2023-09-03 17:56:00'),
(408, 'partner_edit', 'web', '2023-09-03 17:56:00', '2023-09-03 17:56:00'),
(409, 'partner_delete', 'web', '2023-09-03 17:56:00', '2023-09-03 17:56:00'),
(410, 'publication_access', 'web', '2023-09-03 17:56:01', '2023-09-03 17:56:01'),
(411, 'publication_create', 'web', '2023-09-03 17:56:01', '2023-09-03 17:56:01'),
(412, 'publication_show', 'web', '2023-09-03 17:56:01', '2023-09-03 17:56:01'),
(413, 'publication_edit', 'web', '2023-09-03 17:56:01', '2023-09-03 17:56:01'),
(414, 'publication_delete', 'web', '2023-09-03 17:56:01', '2023-09-03 17:56:01'),
(415, 'publicationcategory_access', 'web', '2023-09-03 17:56:01', '2023-09-03 17:56:01'),
(416, 'publicationcategory_create', 'web', '2023-09-03 17:56:01', '2023-09-03 17:56:01'),
(417, 'publicationcategory_show', 'web', '2023-09-03 17:56:01', '2023-09-03 17:56:01'),
(418, 'publicationcategory_edit', 'web', '2023-09-03 17:56:01', '2023-09-03 17:56:01'),
(419, 'publicationcategory_delete', 'web', '2023-09-03 17:56:01', '2023-09-03 17:56:01'),
(420, 'service_access', 'web', '2023-09-03 17:56:02', '2023-09-03 17:56:02'),
(421, 'service_create', 'web', '2023-09-03 17:56:02', '2023-09-03 17:56:02'),
(422, 'service_show', 'web', '2023-09-03 17:56:02', '2023-09-03 17:56:02'),
(423, 'service_edit', 'web', '2023-09-03 17:56:02', '2023-09-03 17:56:02'),
(424, 'service_delete', 'web', '2023-09-03 17:56:02', '2023-09-03 17:56:02'),
(425, 'testimony_access', 'web', '2023-09-03 17:56:02', '2023-09-03 17:56:02'),
(426, 'testimony_create', 'web', '2023-09-03 17:56:02', '2023-09-03 17:56:02'),
(427, 'testimony_show', 'web', '2023-09-03 17:56:02', '2023-09-03 17:56:02'),
(428, 'testimony_edit', 'web', '2023-09-03 17:56:02', '2023-09-03 17:56:02'),
(429, 'testimony_delete', 'web', '2023-09-03 17:56:02', '2023-09-03 17:56:02'),
(430, 'vacancy_access', 'web', NULL, NULL),
(431, 'vacancy_create', 'web', NULL, NULL),
(432, 'vacancy_show', 'web', NULL, NULL),
(433, 'vacancy_edit', 'web', NULL, NULL),
(434, 'vacancy_delete', 'web', NULL, NULL),
(435, 'application_access', 'web', NULL, NULL),
(436, 'application_create', 'web', NULL, NULL),
(437, 'application_show', 'web', NULL, NULL),
(438, 'application_edit', 'web', NULL, NULL),
(439, 'application_delete', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
CREATE TABLE IF NOT EXISTS `publications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publication_category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`id`, `title`, `slug`, `publication_category_id`, `description`, `file`, `cover_image`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `status`) VALUES
(1, 'Smart City Publication', 'smart-city', '1', '<p>A &quot;publications&quot; schema typically refers to a structured format for organizing and storing information about various types of publications, such as books, articles, research papers, and other written works. The schema defines the fields and attributes that each record in the dataset should have. Below is a possible schema for organizing publication records:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Publication Type</strong></p>\r\n\r\n	<ul>\r\n		<li>Type of the publication, e.g., &quot;Book,&quot; &quot;Journal Article,&quot; &quot;Conference Paper,&quot; &quot;Thesis,&quot; etc.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Title</strong></p>\r\n\r\n	<ul>\r\n		<li>The title of the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Authors</strong></p>\r\n\r\n	<ul>\r\n		<li>List of authors who contributed to the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Publication Date</strong></p>\r\n\r\n	<ul>\r\n		<li>The date when the publication was published or released.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Abstract/Summary</strong></p>\r\n\r\n	<ul>\r\n		<li>A brief summary or abstract of the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Keywords</strong></p>\r\n\r\n	<ul>\r\n		<li>Relevant keywords or terms associated with the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Journal/Conference</strong></p>\r\n\r\n	<ul>\r\n		<li>For journal articles or conference papers, the name of the journal or conference where it was published.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Volume and Issue (for Journals)</strong></p>\r\n\r\n	<ul>\r\n		<li>Volume and issue number for journal articles.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Pages</strong></p>\r\n\r\n	<ul>\r\n		<li>Page numbers where the publication appears.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Publisher</strong></p>\r\n\r\n	<ul>\r\n		<li>The entity responsible for publishing the work.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>DOI (Digital Object Identifier)</strong></p>\r\n\r\n	<ul>\r\n		<li>A unique identifier that helps locate the publication online.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>ISBN/ISSN (International Standard Book Number/International Standard Serial Number)</strong></p>\r\n\r\n	<ul>\r\n		<li>Identifiers for books and serial publications, respectively.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>URL/Link</strong></p>\r\n\r\n	<ul>\r\n		<li>A link to access the publication online, if applicable.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Citation</strong></p>\r\n\r\n	<ul>\r\n		<li>A suggested citation format for referencing the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Language</strong></p>\r\n\r\n	<ul>\r\n		<li>The language in which the publication is written.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Publication Status</strong></p>\r\n\r\n	<ul>\r\n		<li>Indication of whether the publication is published, in press, submitted, etc.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Peer Review Status</strong></p>\r\n\r\n	<ul>\r\n		<li>Indication of whether the publication underwent peer review.</li>\r\n	</ul>\r\n	</li>\r\n	<li>&nbsp;</li>\r\n</ol>', 'smart-city-2023-08-28-64ec81afaa0d8.pdf', 'smart-city-2023-08-28-64ec81afa9bd8.png', '2023-08-28 08:14:55', '2023-08-28 09:01:10', NULL, 1, 1),
(2, 'IDTB Publication Document', 'idtb-publication-document', '1', '<p>A &quot;publications&quot; schema typically refers to a structured format for organizing and storing information about various types of publications, such as books, articles, research papers, and other written works. The schema defines the fields and attributes that each record in the dataset should have. Below is a possible schema for organizing publication records:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Publication Type</strong></p>\r\n\r\n	<ul>\r\n		<li>Type of the publication, e.g., &quot;Book,&quot; &quot;Journal Article,&quot; &quot;Conference Paper,&quot; &quot;Thesis,&quot; etc.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Title</strong></p>\r\n\r\n	<ul>\r\n		<li>The title of the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Authors</strong></p>\r\n\r\n	<ul>\r\n		<li>List of authors who contributed to the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Publication Date</strong></p>\r\n\r\n	<ul>\r\n		<li>The date when the publication was published or released.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Abstract/Summary</strong></p>\r\n\r\n	<ul>\r\n		<li>A brief summary or abstract of the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Keywords</strong></p>\r\n\r\n	<ul>\r\n		<li>Relevant keywords or terms associated with the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Journal/Conference</strong></p>\r\n\r\n	<ul>\r\n		<li>For journal articles or conference papers, the name of the journal or conference where it was published.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Volume and Issue (for Journals)</strong></p>\r\n\r\n	<ul>\r\n		<li>Volume and issue number for journal articles.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Pages</strong></p>\r\n\r\n	<ul>\r\n		<li>Page numbers where the publication appears.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Publisher</strong></p>\r\n\r\n	<ul>\r\n		<li>The entity responsible for publishing the work.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>DOI (Digital Object Identifier)</strong></p>\r\n\r\n	<ul>\r\n		<li>A unique identifier that helps locate the publication online.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>ISBN/ISSN (International Standard Book Number/International Standard Serial Number)</strong></p>\r\n\r\n	<ul>\r\n		<li>Identifiers for books and serial publications, respectively.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>URL/Link</strong></p>\r\n\r\n	<ul>\r\n		<li>A link to access the publication online, if applicable.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Citation</strong></p>\r\n\r\n	<ul>\r\n		<li>A suggested citation format for referencing the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Language</strong></p>\r\n\r\n	<ul>\r\n		<li>The language in which the publication is written.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Publication Status</strong></p>\r\n\r\n	<ul>\r\n		<li>Indication of whether the publication is published, in press, submitted, etc.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Peer Review Status</strong></p>\r\n\r\n	<ul>\r\n		<li>Indication of whether the publication underwent peer review.</li>\r\n	</ul>\r\n	</li>\r\n	<li>&nbsp;</li>\r\n</ol>', 'smart-city-2023-08-28-64ec81afaa0d8.pdf', 'smart-city-2023-08-28-64ec81afa9bd8.png', '2023-08-28 08:14:55', '2023-08-28 09:01:10', NULL, 1, 1),
(3, 'A New Proposal', 'a-new-proposal', '1', '<p>A &quot;publications&quot; schema typically refers to a structured format for organizing and storing information about various types of publications, such as books, articles, research papers, and other written works. The schema defines the fields and attributes that each record in the dataset should have. Below is a possible schema for organizing publication records:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Publication Type</strong></p>\r\n\r\n	<ul>\r\n		<li>Type of the publication, e.g., &quot;Book,&quot; &quot;Journal Article,&quot; &quot;Conference Paper,&quot; &quot;Thesis,&quot; etc.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Title</strong></p>\r\n\r\n	<ul>\r\n		<li>The title of the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Authors</strong></p>\r\n\r\n	<ul>\r\n		<li>List of authors who contributed to the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Publication Date</strong></p>\r\n\r\n	<ul>\r\n		<li>The date when the publication was published or released.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Abstract/Summary</strong></p>\r\n\r\n	<ul>\r\n		<li>A brief summary or abstract of the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Keywords</strong></p>\r\n\r\n	<ul>\r\n		<li>Relevant keywords or terms associated with the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Journal/Conference</strong></p>\r\n\r\n	<ul>\r\n		<li>For journal articles or conference papers, the name of the journal or conference where it was published.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Volume and Issue (for Journals)</strong></p>\r\n\r\n	<ul>\r\n		<li>Volume and issue number for journal articles.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Pages</strong></p>\r\n\r\n	<ul>\r\n		<li>Page numbers where the publication appears.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Publisher</strong></p>\r\n\r\n	<ul>\r\n		<li>The entity responsible for publishing the work.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>DOI (Digital Object Identifier)</strong></p>\r\n\r\n	<ul>\r\n		<li>A unique identifier that helps locate the publication online.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>ISBN/ISSN (International Standard Book Number/International Standard Serial Number)</strong></p>\r\n\r\n	<ul>\r\n		<li>Identifiers for books and serial publications, respectively.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>URL/Link</strong></p>\r\n\r\n	<ul>\r\n		<li>A link to access the publication online, if applicable.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Citation</strong></p>\r\n\r\n	<ul>\r\n		<li>A suggested citation format for referencing the publication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Language</strong></p>\r\n\r\n	<ul>\r\n		<li>The language in which the publication is written.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Publication Status</strong></p>\r\n\r\n	<ul>\r\n		<li>Indication of whether the publication is published, in press, submitted, etc.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Peer Review Status</strong></p>\r\n\r\n	<ul>\r\n		<li>Indication of whether the publication underwent peer review.</li>\r\n	</ul>\r\n	</li>\r\n	<li>&nbsp;</li>\r\n</ol>', 'smart-city-2023-08-28-64ec81afaa0d8.pdf', 'smart-city-2023-08-28-64ec81afa9bd8.png', '2023-08-28 08:14:55', '2023-08-28 09:01:10', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `publication_categories`
--

DROP TABLE IF EXISTS `publication_categories`;
CREATE TABLE IF NOT EXISTS `publication_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publication_categories`
--

INSERT INTO `publication_categories` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Scientific Research', 'scientific-research-2023-08-28-64ec7e8c2fc19.png', '2023-08-28 08:01:32', '2023-08-28 08:01:32', NULL, 1),
(2, 'Technology and Engineering', 'technology-and-engineering-2023-08-28-64ec7eece3959.png', '2023-08-28 08:03:08', '2023-08-28 08:03:08', NULL, 1),
(3, 'Medical and Healthcare', 'medical-and-healthcare-2023-08-28-64ec7f02d2f3a.png', '2023-08-28 08:03:30', '2023-08-28 08:03:30', NULL, 1),
(4, 'Social Sciences', 'social-sciences-2023-08-28-64ec7f125cdf7.png', '2023-08-28 08:03:46', '2023-08-28 08:03:46', NULL, 1),
(5, 'Education', 'education-2023-08-28-64ec7f42afde5.png', '2023-08-28 08:04:34', '2023-09-01 04:43:11', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'Editor', 'web', '2023-09-03 14:42:47', '2023-09-04 09:05:12'),
(4, 'Super Admin', 'web', '2023-09-03 17:56:03', '2023-09-03 17:56:03'),
(5, 'User', 'web', '2023-09-03 17:56:03', '2023-09-03 17:56:03');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(325, 3),
(326, 3),
(327, 3),
(328, 3),
(329, 3),
(342, 3),
(345, 3),
(347, 3),
(350, 3),
(365, 3),
(366, 3),
(367, 3),
(370, 3),
(386, 3),
(325, 4),
(326, 4),
(327, 4),
(328, 4),
(329, 4),
(330, 4),
(331, 4),
(332, 4),
(333, 4),
(334, 4),
(335, 4),
(336, 4),
(337, 4),
(338, 4),
(339, 4),
(340, 4),
(341, 4),
(342, 4),
(343, 4),
(344, 4),
(345, 4),
(346, 4),
(347, 4),
(348, 4),
(349, 4),
(350, 4),
(351, 4),
(352, 4),
(353, 4),
(354, 4),
(355, 4),
(356, 4),
(357, 4),
(358, 4),
(359, 4),
(360, 4),
(361, 4),
(362, 4),
(363, 4),
(364, 4),
(365, 4),
(366, 4),
(367, 4),
(368, 4),
(369, 4),
(370, 4),
(371, 4),
(372, 4),
(373, 4),
(374, 4),
(375, 4),
(376, 4),
(377, 4),
(378, 4),
(379, 4),
(380, 4),
(381, 4),
(382, 4),
(383, 4),
(384, 4),
(385, 4),
(386, 4),
(387, 4),
(388, 4),
(389, 4),
(390, 4),
(391, 4),
(392, 4),
(393, 4),
(394, 4),
(395, 4),
(396, 4),
(397, 4),
(398, 4),
(399, 4),
(400, 4),
(401, 4),
(402, 4),
(403, 4),
(404, 4),
(405, 4),
(406, 4),
(407, 4),
(408, 4),
(409, 4),
(410, 4),
(411, 4),
(412, 4),
(413, 4),
(414, 4),
(415, 4),
(416, 4),
(417, 4),
(418, 4),
(419, 4),
(420, 4),
(421, 4),
(422, 4),
(423, 4),
(424, 4),
(425, 4),
(426, 4),
(427, 4),
(428, 4),
(429, 4),
(430, 4),
(431, 4),
(432, 4),
(433, 4),
(434, 4),
(435, 4),
(436, 4),
(437, 4),
(438, 4),
(439, 4),
(325, 5),
(326, 5),
(327, 5),
(328, 5),
(329, 5),
(330, 5),
(331, 5),
(332, 5),
(333, 5),
(334, 5),
(335, 5),
(336, 5),
(337, 5),
(338, 5),
(339, 5),
(340, 5),
(341, 5),
(342, 5),
(343, 5),
(344, 5),
(345, 5),
(346, 5),
(347, 5),
(348, 5),
(349, 5),
(350, 5),
(351, 5),
(352, 5),
(353, 5),
(354, 5),
(355, 5),
(356, 5),
(357, 5),
(358, 5),
(359, 5),
(360, 5),
(361, 5),
(362, 5),
(363, 5),
(364, 5),
(365, 5),
(366, 5),
(367, 5),
(368, 5),
(369, 5),
(370, 5),
(371, 5),
(372, 5),
(373, 5),
(374, 5),
(375, 5),
(376, 5),
(377, 5),
(378, 5),
(379, 5),
(380, 5),
(381, 5),
(382, 5),
(383, 5),
(384, 5),
(385, 5),
(386, 5),
(387, 5),
(388, 5),
(389, 5),
(390, 5),
(391, 5),
(392, 5),
(393, 5),
(394, 5),
(395, 5),
(396, 5),
(397, 5),
(398, 5),
(399, 5),
(400, 5),
(401, 5),
(402, 5),
(403, 5),
(404, 5),
(405, 5),
(406, 5),
(407, 5),
(408, 5),
(409, 5),
(410, 5),
(411, 5),
(412, 5),
(413, 5),
(414, 5),
(415, 5),
(416, 5),
(417, 5),
(418, 5),
(419, 5),
(420, 5),
(421, 5),
(422, 5),
(423, 5),
(424, 5),
(425, 5),
(426, 5),
(427, 5),
(428, 5),
(429, 5);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `directorate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `directorate_id`, `description`, `icon`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Conducting research', 1, 'Service description for conducting research.', 'fa-solid fa-print', NULL, 1, '2023-09-01 06:02:15', '2023-09-01 06:02:38'),
(2, 'Implementation of smart technology', 4, 'Service description for implementing smart technology.', 'fa-solid fa-database', NULL, 1, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(3, 'Improvement and implementation of innovation and technology programs, standards', 4, 'Service description for improving and implementing innovation and technology programs and standards.', 'fa-solid fa-microchip', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(4, 'Development of a city-wide database', 2, 'Service description for developing a city-wide database.', 'fa-solid fa-print', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(5, 'City-wide database management', 4, 'Service description for city-wide database management.', 'fa-solid fa-database', NULL, 1, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(6, 'Information technology infrastructure feasibility study', 1, 'Service description for IT infrastructure feasibility study.', 'fa-solid fa-database', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(7, 'Information technology infrastructure design', 3, 'Service description for IT infrastructure design.', 'fa-solid fa-computer', NULL, 1, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(8, 'Development of information technology infrastructure', 2, 'Service description for developing IT infrastructure.', 'fa-solid fa-computer', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(9, 'Software system development feasibility study', 2, 'Service description for software system development feasibility study.', 'fa-solid fa-city', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(10, 'Software system design', 2, 'Service description for software system design.', 'fa-solid fa-city', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(11, 'Developing software systems', 4, 'Service description for developing software systems.', 'fa-solid fa-computer', NULL, 1, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(12, 'Integration of information technology', 4, 'Service description for integrating IT.', 'fa-solid fa-print', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(13, 'Controlling the management of information technology infrastructure', 1, 'Service description for controlling IT infrastructure management.', 'fa-solid fa-book', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(14, 'Managing the software system', 2, 'Service description for managing software systems.', 'fa-solid fa-computer', NULL, 1, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(15, 'Information Technology Consulting, Professional Licensing', 4, 'Service description for IT consulting and professional licensing.', 'fa-solid fa-microchip', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(16, 'Information technology capacity building', 1, 'Service description for IT capacity building.', 'fa-solid fa-print', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(17, 'Information technology infrastructure maintenance, renewal and disposal', 1, 'Service description for IT infrastructure maintenance, renewal, and disposal.', 'fa-solid fa-computer', NULL, 1, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(18, 'Controlling the security of information and publications of the city administration', 2, 'Service description for controlling IT security and publications.', 'fa-solid fa-book', NULL, 1, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(19, 'Information Technology Audit', 2, 'Service description for IT audit.', 'fa-solid fa-computer', NULL, 1, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(20, 'Cyber Security Audit', 3, 'Service description for cyber security audit.', 'fa-solid fa-print', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(21, 'Cloud Data Center Service', 4, 'Service description for cloud data center.', 'fa-solid fa-book', NULL, 1, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(22, 'Information Technology Center of Excellence; Organizing Incubation Center', 2, 'Service description for IT center of excellence and organizing incubation center.', 'fa-solid fa-city', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(23, 'Supporting indigenous technologies and information technology transfer', 4, 'Service description for supporting indigenous technologies and IT transfer.', 'fa-solid fa-city', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(24, 'Supporting the urban administration curriculum with technology', 1, 'Service description for supporting urban administration curriculum with technology.', 'fa-solid fa-city', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(25, 'Implementation of e-government and digitalization', 3, 'Service description for implementing e-government and digitalization.', 'fa-solid fa-microchip', NULL, 1, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(26, 'Recognition for innovation and technology development and creative works', 1, 'Service description for recognizing innovation and technology development.', 'fa-solid fa-computer', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(27, 'Ensuring the quality of information technology infrastructure and systems', 3, 'Service description for ensuring IT infrastructure and systems quality.', 'fa-solid fa-microchip', NULL, 0, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(28, 'Geographical Information System Platform Service', 3, 'Service description for GIS platform.', 'fa-solid fa-book', NULL, 1, '2023-09-01 06:02:15', '2023-09-01 06:02:15'),
(29, 'Test', 1, '<p>$th-&gt;getMessage()</p>', 'fa-regular fa-lightbulb', NULL, 0, '2023-09-01 07:24:37', '2023-09-01 07:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `siteTitle` longtext COLLATE utf8mb4_unicode_ci,
  `SiteMoto` longtext COLLATE utf8mb4_unicode_ci,
  `logo_transparent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_white` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_footer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` longtext COLLATE utf8mb4_unicode_ci,
  `sitedescription` longtext COLLATE utf8mb4_unicode_ci,
  `no_livers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_projects` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_services` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hours` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_social` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_note` longtext COLLATE utf8mb4_unicode_ci,
  `contact_note` longtext COLLATE utf8mb4_unicode_ci,
  `about_note` longtext COLLATE utf8mb4_unicode_ci,
  `about_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vision` longtext COLLATE utf8mb4_unicode_ci,
  `mission` longtext COLLATE utf8mb4_unicode_ci,
  `objectives` longtext COLLATE utf8mb4_unicode_ci,
  `values` longtext COLLATE utf8mb4_unicode_ci,
  `focuses` longtext COLLATE utf8mb4_unicode_ci,
  `footer_note_am` longtext COLLATE utf8mb4_unicode_ci,
  `contact_note_am` longtext COLLATE utf8mb4_unicode_ci,
  `about_note_am` longtext COLLATE utf8mb4_unicode_ci,
  `vision_am` longtext COLLATE utf8mb4_unicode_ci,
  `mission_am` longtext COLLATE utf8mb4_unicode_ci,
  `objectives_am` longtext COLLATE utf8mb4_unicode_ci,
  `values_am` longtext COLLATE utf8mb4_unicode_ci,
  `focuses_am` longtext COLLATE utf8mb4_unicode_ci,
  `footer_note_or` longtext COLLATE utf8mb4_unicode_ci,
  `contact_note_or` longtext COLLATE utf8mb4_unicode_ci,
  `about_note_or` longtext COLLATE utf8mb4_unicode_ci,
  `vision_or` longtext COLLATE utf8mb4_unicode_ci,
  `mission_or` longtext COLLATE utf8mb4_unicode_ci,
  `objectives_or` longtext COLLATE utf8mb4_unicode_ci,
  `values_or` longtext COLLATE utf8mb4_unicode_ci,
  `focuses_or` longtext COLLATE utf8mb4_unicode_ci,
  `phone` longtext COLLATE utf8mb4_unicode_ci,
  `emailNoReply` longtext COLLATE utf8mb4_unicode_ci,
  `emailInfo` longtext COLLATE utf8mb4_unicode_ci,
  `google_map` longtext COLLATE utf8mb4_unicode_ci,
  `about_us` longtext COLLATE utf8mb4_unicode_ci,
  `facebook` longtext COLLATE utf8mb4_unicode_ci,
  `instagram` longtext COLLATE utf8mb4_unicode_ci,
  `youtube` longtext COLLATE utf8mb4_unicode_ci,
  `telegram` longtext COLLATE utf8mb4_unicode_ci,
  `twitter` longtext COLLATE utf8mb4_unicode_ci,
  `whatsapp` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `siteTitle`, `SiteMoto`, `logo_transparent`, `logo_white`, `logo_footer`, `favicon`, `keywords`, `sitedescription`, `no_livers`, `no_projects`, `no_services`, `no_hours`, `no_social`, `footer_note`, `contact_note`, `about_note`, `about_image`, `vision`, `mission`, `objectives`, `values`, `focuses`, `footer_note_am`, `contact_note_am`, `about_note_am`, `vision_am`, `mission_am`, `objectives_am`, `values_am`, `focuses_am`, `footer_note_or`, `contact_note_or`, `about_note_or`, `vision_or`, `mission_or`, `objectives_or`, `values_or`, `focuses_or`, `phone`, `emailNoReply`, `emailInfo`, `google_map`, `about_us`, `facebook`, `instagram`, `youtube`, `telegram`, `twitter`, `whatsapp`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'IDTB', 'Addis Ababa, 5 Kilo', 'idtb-2023-09-05-64f6e32cd6b10.png', 'idtb-2023-09-04-64f6285f48d89.png', 'idtb-2023-09-04-64f62884c752e.jpg', 'idtb-2023-09-05-64f6e8312640c.png', 'Smart city, Addis Ababa City Innovation and Technology Development Bureau (ITDB) is a government organization that was originally constituted as an agency in April 2009 GC under proclamation No. 11/2009.', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB) is a government organization that was originally constituted as an agency in April 2009 GC under proclamation No. 11/2009.', '40000', '8988', '78', '2900', '10000', '<p>Addis Ababa City Innovation and Technology Development Bureau (ITDB) is a government organization that was originally constituted as an agency in April 2009 GC under proclamation No. 11/2009.</p>', '<p>Feel free to contact us for any inquiries.</p>', '<p>Addis Ababa City Innovation and Technology Development Bureau (ITDB) is a government organization that was originally constituted as an agency in April 2009 GC under proclamation No. 11/2009. The agency had been incorporated with the Technique and Vocational Training Agency and acquired a bureau structure as a result of the restructuring of the city&#39;s executive bodies in September 2019 GC. The institution has been carrying out various activities since the time it is established in the level of agency up to these days with a view to realize the vision to see building up of bridge to transform the city to overall ICT.</p>', NULL, '<p>By 2025, implementing major IT technologies that are convenient for its residents and visitors; seeing Addis Ababa as a sustainable and resilient city.</p>', '<p>Ensuring the benefit of the residents and visitors of Addis Ababa by implementing information technology infrastructures supported by research and, enhancing secure systems and expanding digital services.</p>', '<ul>\r\n	<li>Availability</li>\r\n	<li>Affordability</li>\r\n	<li>Accessibility</li>\r\n	<li>Sustainability</li>\r\n	<li>Resilient</li>\r\n	<li>Advocate Technologies</li>\r\n	<li>Economically Thrive</li>\r\n	<li>Environmental Friendly</li>\r\n	<li>Health and Safety</li>\r\n	<li>Quality of Life</li>\r\n</ul>', '<ul>\r\n	<li>Availability</li>\r\n	<li>Affordability</li>\r\n	<li>Accessibility</li>\r\n	<li>Sustainability</li>\r\n	<li>Resilient</li>\r\n	<li>Advocate Technologies</li>\r\n	<li>Economically Thrive</li>\r\n	<li>Environmental Friendly</li>\r\n	<li>Health and Safety</li>\r\n	<li>Quality of Life</li>\r\n</ul>', '<p>Customer satisfaction, Innovation.</p>', '<p>የአዲስ አበባ ከተማ ኢኖቬሽንና ቴክኖሎጂ ልማት ቢሮ በአዋጅ ቁጥር 11/2009 በኤጀንሲነት የተቋቋመው በመጀመሪያ በሚያዝያ 2009 ዓ.ም.</p>', '<p>Delivering innovative solutions and exceeding expectations</p>', '<p>የአዲስ አበባ ከተማ ኢኖቬሽንና ቴክኖሎጂ ልማት ቢሮ በአዋጅ ቁጥር 11/2009 በኤጀንሲነት የተቋቋመው በመጀመሪያ በሚያዝያ 2009 ዓ.ም. ኤጀንሲው ከቴክኒክና ሙያ ማሰልጠኛ ኤጀንሲ ጋር በመዋሃድ የቢሮ መዋቅር አግኝቷል። ተቋሙ ድልድይ በመገንባት ከተማዋን ወደ አጠቃላይ የአይሲቲ የማሸጋገር ራዕይ እውን ለማድረግ በኤጀንሲ ደረጃ ከተቋቋመበት ጊዜ አንስቶ እስከ አሁን ድረስ የተለያዩ ተግባራትን ሲያከናውን ቆይቷል።</p>', '<p>በ 2025 ዋና ዋና የአይቲ ቴክኖሎጂዎችን በመተግበር ለነዋሪዎቿ እና ለጎብኚዎች ምቹ; አዲስ አበባን እንደ ዘላቂ እና የማይበገር ከተማ ማየት።</p>', '<p>የኢንፎርሜሽን ቴክኖሎጂ መሠረተ ልማቶችን በጥናት የተደገፈ በመተግበር እና አስተማማኝ አሰራርን በማሳደግ እና የዲጂታል አገልግሎቶችን በማስፋፋት የአዲስ አበባ ነዋሪዎችንና ጎብኝዎችን ተጠቃሚነት ማረጋገጥ።</p>', '<ul>\r\n	<li>ተገኝነት</li>\r\n	<li>ተመጣጣኝነት</li>\r\n	<li>ተደራሽነት</li>\r\n	<li>ዘላቂነት</li>\r\n	<li>የሚቋቋም</li>\r\n	<li>ተሟጋች ቴክኖሎጂዎች</li>\r\n	<li>በኢኮኖሚ እድገት</li>\r\n	<li>ለአካባቢ ተስማሚ</li>\r\n	<li>ጤና እና ደህንነት</li>\r\n	<li>የህይወት ጥራት</li>\r\n</ul>', '<ul>\r\n	<li>ተገኝነት</li>\r\n	<li>ተመጣጣኝነት</li>\r\n	<li>ተደራሽነት</li>\r\n	<li>ዘላቂነት</li>\r\n	<li>የሚቋቋም</li>\r\n	<li>ተሟጋች ቴክኖሎጂዎች</li>\r\n	<li>በኢኮኖሚ እድገት</li>\r\n	<li>ለአካባቢ ተስማሚ</li>\r\n	<li>ጤና እና ደህንነት</li>\r\n	<li>የህይወት ጥራት</li>\r\n</ul>', '<p>Delivering innovative solutions and exceeding expectations</p>', '<p>Biiroon Misooma Innooveeshinii fi Teeknooloojii Magaalaa Addis Ababa (ITDB) dhaabbata mootummaa jalqaba Ebla 2009 GC labsii lakk.</p>', '<p>Delivering innovative solutions and exceeding expectations</p>', '<p>Biiroon Misooma Innooveeshinii fi Teeknooloojii Magaalaa Addis Ababa (ITDB) dhaabbata mootummaa jalqaba Ebla 2009 GC labsii lakk. Ejensichi Ejensii Leenjii Teeknikaa fi Ogummaa waliin kan makame yoo ta&rsquo;u, sababa gurmaa&rsquo;insa qaamolee raawwachiiftuu magaalichaa Adoolessa bara 2019 GC caasaa biiroo argateera. Dhaabbatichi yeroo hundeeffamee kaasee sadarkaa ejensiitiin hanga guyyoota kanatti hojiiwwan adda addaa raawwachaa kan ture yoo ta&rsquo;u, mul&rsquo;ata ijaarsa riqicha magaalattii gara TQO waliigalaatti jijjiiruu arguuf mul&rsquo;atu dhugoomsuudhaaf yaadameeti.</p>', '<p>Bara 2025tti teeknooloojiiwwan IT gurguddoo jiraattotaa fi daawwattoota isaaf mijatan hojiirra oolchuu; Addis Ababa akka magaalaa itti fufiinsa qabuu fi dandamattuutti ilaaluun.</p>', '<p>Bu&rsquo;uuraalee teeknooloojii odeeffannoo qorannoodhaan deeggaraman hojiirra oolchuu fi, sirnoota nageenya qaban guddisuu fi tajaajila dijitaalaa babal&rsquo;isuudhaan jiraattotaa fi daawwattoota Addis Ababaa mirkaneessuu.</p>', '<ul>\r\n	<li>Argamuu</li>\r\n	<li>Gatii madaalawaa</li>\r\n	<li>Dhaqqabummaa</li>\r\n	<li>Itti fufiinsa</li>\r\n	<li>Dandeettii</li>\r\n	<li>Teeknooloojiiwwan leellisuu</li>\r\n	<li>Diinagdeen ni dagaagu</li>\r\n	<li>Naannoodhaaf mijachuu</li>\r\n	<li>Fayyaa fi Nageenya</li>\r\n	<li>Qulqullina Jireenyaa</li>\r\n</ul>', '<ul>\r\n	<li>Argamuu</li>\r\n	<li>Gatii madaalawaa</li>\r\n	<li>Dhaqqabummaa</li>\r\n	<li>Itti fufiinsa</li>\r\n	<li>Dandeettii</li>\r\n	<li>Teeknooloojiiwwan leellisuu</li>\r\n	<li>Diinagdeen ni dagaagu</li>\r\n	<li>Naannoodhaaf mijachuu</li>\r\n	<li>Fayyaa fi Nageenya</li>\r\n	<li>Qulqullina Jireenyaa</li>\r\n</ul>', '<p>Delivering innovative solutions and exceeding expectations</p>', '+1234567890', 'noreply@example.com', 'info@example.com', 'https://maps.google.com/example', NULL, 'https://www.facebook.com/example', 'https://www.instagram.com/example', 'https://youtu.be/VRRPy-yEKRM?si=L5n4NRSIZkd75hZB', 'https://t.me/example', 'https://twitter.com/example', 'https://www.whatsapp.com/', '2023-08-26 06:32:12', '2023-09-05 05:34:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonies`
--

DROP TABLE IF EXISTS `testimonies`;
CREATE TABLE IF NOT EXISTS `testimonies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonies`
--

INSERT INTO `testimonies` (`id`, `fullname`, `title`, `image`, `is_enabled`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Biruk Fekade', 'CTO', '-2023-08-26-64ea121ec093c.JPG', 1, 'Navigating the website was a breeze, with a user-friendly interface that allowed me to easily explore all the services they offer. The layout is not only visually appealing but also intuitively designed, making it simple to find the information I was looking for. Whether it was details about their various fitness programs, class schedules, or membership options, everything was just a click away.', '2023-08-26 11:54:22', '2023-08-26 11:54:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `user_id`, `status`) VALUES
(11, 'Biruk Fekade Baye', 'bkfekade@gmail.com', '+251949904135', NULL, '$2y$10$KpxBJMikqJs6CPJkXcbbCOOmK9TZDfMMlQ6nHsMyIZipdzmjlGvQ.', '8U1mAMXHx3Xyzh1Q4shkPHgVxnaKJd2NxtO2TDjvUYpuYLcUAGFXTfahCxbY', '2023-09-04 09:02:25', '2023-09-06 11:03:33', 1, 1),
(2, 'Israel', 'Israel@gmail.com', '0911111161', NULL, '$2y$10$MenRkYfehojC86/bcNMaMOMIlQgM7ueZg04GrZLON.jUMtltSm3zK', NULL, '2023-08-30 06:50:48', '2023-08-30 06:50:48', 1, 1),
(3, 'Yemane', 'yemane@gmail.com', '0987654321', NULL, '$2y$10$upMT1Zk.7n1fL7doSmE6c.b7XGdDiH/IfkxtLsIoPsWD8FgfEHxVe', NULL, '2023-08-30 09:16:02', '2023-08-30 09:16:02', 1, 1),
(8, 'Habtewold', 'habt@gmail.com', NULL, NULL, '$2y$10$pVIPMoxk/JS16dnw7ao9GuGzCt5JJXkjIXfUdj9SzsKcxfJQr8hSK', NULL, '2023-09-03 17:58:30', '2023-09-03 17:58:30', 1, 1),
(9, 'habtewold', 'beruk@gmail.com', '0987654329', NULL, '$2y$10$Y36p3ifRGLrUOZwmKc5Y0um.ZUFtIuyUny1CxFMB83K0QjOo7rd5O', NULL, '2023-09-03 18:03:24', '2023-09-03 18:03:24', 1, 1),
(10, 'bure', 'appl@gmail.com', '0911135966', NULL, '$2y$10$TFAibLF1pV6xg3DklnGNhO2AdD/nHEDJ3DL/whoqkWuh5GG43GVv6', NULL, '2023-09-04 03:35:32', '2023-09-04 03:35:32', 1, 1),
(12, 'Comm', 'com@gmail.com', '0987676767', NULL, '$2y$10$rPnu7W9IpNMrBQl/n.To4uvDH8OEnzpd1vBaYpAHaaCsnZVJHtKia', NULL, '2023-09-05 02:23:09', '2023-09-05 02:23:09', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

DROP TABLE IF EXISTS `vacancies`;
CREATE TABLE IF NOT EXISTS `vacancies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `directorate_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `career_level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_description` longtext COLLATE utf8mb4_unicode_ci,
  `job_requirements` longtext COLLATE utf8mb4_unicode_ci,
  `how_to_apply` longtext COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`id`, `job_title`, `slug`, `department_id`, `directorate_id`, `location`, `career_level`, `employment_type`, `job_description`, `job_requirements`, `how_to_apply`, `email`, `phone`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Software Developer', 'software-developer', NULL, NULL, 'Addis Ababa, Head Office', 'Intermediate', 'Full time', '<p>Job Description:<br />\r\nAs a Software Developer at [Your Company Name], you will play a key role in designing, developing, and maintaining software applications that meet our clients&#39; needs. You will collaborate with a team of skilled developers and engineers to deliver high-quality software solutions.</p>\r\n\r\n<p>Responsibilities:</p>\r\n\r\n<p>Collaborate with cross-functional teams to define, design, and ship new features<br />\r\nWrite clean, efficient, and maintainable code<br />\r\nDebug and resolve software defects and issues<br />\r\nParticipate in code and design reviews<br />\r\nStay up-to-date with emerging technologies and industry trends</p>', '<p>Requirements:</p>\r\n\r\n<p>Bachelor&#39;s degree in Computer Science or a related field (or equivalent work experience)<br />\r\nProven experience in software development, including designing, coding, testing, and debugging<br />\r\nProficiency in one or more programming languages such as Python, Java, C++, or JavaScript<br />\r\nStrong problem-solving and analytical skills<br />\r\nExcellent communication and teamwork abilities<br />\r\nFamiliarity with software development methodologies and best practices<br />\r\nPreferred Qualifications:</p>\r\n\r\n<p>Experience with web development frameworks and technologies (e.g., React, Angular, Node.js)<br />\r\nKnowledge of database systems (SQL, NoSQL)<br />\r\nFamiliarity with version control systems (e.g., Git)<br />\r\nExperience with cloud computing platforms (e.g., AWS, Azure, Google Cloud)<br />\r\nUnderstanding of software security best practices<br />\r\nBenefits:</p>\r\n\r\n<p>Competitive salary<br />\r\nHealth, dental, and vision insurance<br />\r\n401(k) retirement plan with company matching<br />\r\nFlexible work hours<br />\r\nProfessional development opportunities<br />\r\nFriendly and collaborative work environment<br />\r\nEmployee wellness programs<br />\r\n&nbsp;</p>', '<p>How to Apply:<br />\r\nInterested candidates are invited to send their resume and a cover letter detailing their relevant experience to [Email Address]. Please include &quot;Software Developer Application&quot; in the subject line of your email.</p>', 'bkfekade@gmail.com', '+251949904135', 1, '2023-09-04 09:22:46', '2023-09-04 09:22:46', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
