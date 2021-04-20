-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2021 at 09:18 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itpc`
--

-- --------------------------------------------------------

--
-- Table structure for table `itpc_about`
--

CREATE TABLE `itpc_about` (
  `about_id` int(11) NOT NULL,
  `about_title` varchar(300) NOT NULL,
  `about_content` longtext NOT NULL,
  `about_header` varchar(100) NOT NULL,
  `function_content` mediumtext NOT NULL,
  `function_image` varchar(100) NOT NULL,
  `mission_content` mediumtext NOT NULL,
  `mission_image` varchar(100) NOT NULL,
  `trans_key` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_about`
--

INSERT INTO `itpc_about` (`about_id`, `about_title`, `about_content`, `about_header`, `function_content`, `function_image`, `mission_content`, `mission_image`, `trans_key`) VALUES
(1, 'Indonesian Trade Promotion Centre, Barcelona', '<p>ITPC, short for Indonesian Trade Promotion Centre is a non profit government organization under the supervision of the Directorate General for National Export Development (before called National Agency for Export Development or NAFED). Both institution are part of global trade network abroad supervised by the Ministry of Trade of the Republic of Indonesia, with a common goal to enhance the export of Indonesian products thought the world. Facing the rapid growth of global economy, especially in a very competitive environment, ITPC provides services for Spanish business partners with facilitation to enhance two-way trade engagements and expected to bridge and connect potential traders between Indonesian and Spain.</p>\r\n<p>Through ITPC Barcelona website, Indonesia&rsquo;s exporters could offer their products to the abroad buyers and on the other side; buyers could find good product suppliers from Indonesia&rsquo;s companies. All these services and facilities are free of charge to everybody.</p>', 'Rectangle 47.png', '<ul> <li>Provide facility for Marketing of Indonesian export products and enhancement of the trade mission in the accredited countries</li> <li>Provide facility for Development of the business contacts and cooperation between Indonesian business council and the business communities in the accredited countries (business matching)</li> <li>Provide the business information and market opportunities in host countries and assist Indonesian business community about potential products in overseas markets</li> <li>Provide the information services on the potential export products to the foreign buyers</li> <li>Undertake the market analysis and improving business Intelligence and networking with business communities in host countries</li> <li>Disseminating information to the Spanish business communities;</li> <li>Prepare the work program and budgets as well as administrative and financial duties corresponding to the existing regulation</li> </ul>', 'Rectangle 52.png', '<ul> <li>To boost the Indonesian non oil and gas export development to the Spain through market penetration, information, dissemination, trade inquiry services, expanding the business contacts between Indonesian exporters and Spanish importers, and active participation in various trade exhibition in Spain.</li> <li>To assist Indonesian companies in participating trade shows throughout the Spain.</li> <li>Promoting international trade by providing trade inquiry services to Indonesian companies and Spanish companies.</li> <li>Matchmaking assistance, arranging the meeting between Indonesian exporters and Spanish importers.<br />Promoting Indonesian economic growth to enhance business contracts between Indonesian exporters and U.S. importers.</li> </ul>', 'Rectangle 52.png', 'about_key-1615518208');

-- --------------------------------------------------------

--
-- Table structure for table `itpc_contact`
--

CREATE TABLE `itpc_contact` (
  `contact_id` int(1) NOT NULL,
  `contact_header` varchar(100) DEFAULT NULL,
  `trans_key` varchar(100) DEFAULT NULL,
  `contact_map` text NOT NULL,
  `contact_location` text NOT NULL,
  `contact_phone` varchar(50) NOT NULL,
  `contact_fax` varchar(50) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_website` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itpc_contact`
--

INSERT INTO `itpc_contact` (`contact_id`, `contact_header`, `trans_key`, `contact_map`, `contact_location`, `contact_phone`, `contact_fax`, `contact_email`, `contact_website`) VALUES
(1, 'Rectangle 47.png', 'contact_key-1615518208', '<iframe style=\"border: 0;\" src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2992.974736867991!2d2.149264!3d41.396355!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4a29ea4041ad5%3A0xae31dc9fbeeee269!2sCarrer%20d\'Aribau%2C%20250%2C%2008006%20Barcelona%2C%20Spain!5e0!3m2!1sen!2sus!4v1616054212896!5m2!1sen!2sus\" width=\"100%\" height=\"450\" allowfullscreen=\"allowfullscreen\"></iframe>', 'Calle Aribau 250 Bj.08006, Barcelona, Spain', '+34 934 144 662', '+34 934 146 188', 'info@itpc-barcelona.es', 'http://www.itpc-barcelona.es/');

-- --------------------------------------------------------

--
-- Table structure for table `long_translations`
--

CREATE TABLE `long_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `trans_key` varchar(255) NOT NULL,
  `english` longtext DEFAULT NULL,
  `bahasa` longtext DEFAULT NULL,
  `spanyol` longtext DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `long_translations`
--

INSERT INTO `long_translations` (`id`, `trans_key`, `english`, `bahasa`, `spanyol`, `deleted_by`, `deleted_at`, `updated_by`, `updated_at`, `created_by`, `created_at`) VALUES
(1, 'news_key-1615517813', '<p>asdsadsa</p>', '<p>asdasdas asdsad</p>', '<p>asdasd asdasda asdsadad</p>', NULL, NULL, 1, '2021-03-12 03:56:53', 1, '2021-03-12 03:56:53'),
(2, 'news_key-1615518151', '<p>asdsadsa 32</p>', '<p>asdasdas asdsad w2</p>', '<p>asdasd asdasda asdsadad 2</p>', NULL, NULL, 1, '2021-03-12 04:02:31', 1, '2021-03-12 04:02:31'),
(3, 'news_key-1615518208', '<p>asdsadsa 32</p>', '<p>asdasdas asdsad w2</p>', '<p>asdasd asdasda asdsadad 2</p>', NULL, NULL, 1, '2021-03-12 04:03:28', 1, '2021-03-12 04:03:28'),
(4, 'about_key-1615518208', '<p>ITPC, short for Indonesian Trade Promotion Centre is a non profit government organization under the supervision of the Directorate General for National Export Development (before called National Agency for Export Development or NAFED). Both institution are part of global trade network abroad supervised by the Ministry of Trade of the Republic of Indonesia, with a common goal to enhance the export of Indonesian products thought the world. Facing the rapid growth of global economy, especially in a very competitive environment, ITPC provides services for Spanish business partners with facilitation to enhance two-way trade engagements and expected to bridge and connect potential traders between Indonesian and Spain.</p>\r\n<p>Through ITPC Barcelona website, Indonesia&rsquo;s exporters could offer their products to the abroad buyers and on the other side; buyers could find good product suppliers from Indonesia&rsquo;s companies. All these services and facilities are free of charge to everybody.</p>', '<p> ITPC, singkatan dari Indonesian Trade Promotion Center adalah lembaga pemerintah nirlaba di bawah pengawasan Direktorat Jenderal Pengembangan Ekspor Nasional (sebelumnya disebut Badan Pengembangan Ekspor Nasional atau NAFED). Kedua lembaga tersebut merupakan bagian dari jaringan perdagangan global luar negeri yang diawasi oleh Kementerian Perdagangan Republik Indonesia, dengan tujuan yang sama untuk meningkatkan ekspor produk Indonesia ke mata dunia. Menghadapi pertumbuhan ekonomi global yang pesat, terutama dalam lingkungan yang sangat kompetitif, ITPC menyediakan layanan bagi mitra bisnis Spanyol dengan fasilitasi untuk meningkatkan keterlibatan perdagangan dua arah dan diharapkan dapat menjembatani serta menghubungkan para pedagang potensial antara Indonesia dan Spanyol. </p>\r\n<p> Melalui situs ITPC Barcelona, ​​para eksportir Indonesia dapat menawarkan produknya kepada pembeli di luar negeri dan di sisi lain; pembeli dapat menemukan pemasok produk yang bagus dari perusahaan Indonesia. Semua layanan dan fasilitas ini gratis untuk semua orang. </p>', '<p> ITPC, abreviatura de Centro de Promoción Comercial de Indonesia es una organización gubernamental sin fines de lucro bajo la supervisión de la Dirección General de Desarrollo Nacional de Exportaciones (antes llamada Agencia Nacional de Desarrollo de Exportaciones o NAFED). Ambas instituciones forman parte de la red de comercio global en el exterior supervisada por el Ministerio de Comercio de la República de Indonesia, con el objetivo común de mejorar la exportación de productos indonesios al mundo. Frente al rápido crecimiento de la economía global, especialmente en un entorno muy competitivo, ITPC ofrece servicios para socios comerciales españoles con facilitación para mejorar los compromisos comerciales bidireccionales y se espera que sirva de puente y conecte a los comerciantes potenciales entre Indonesia y España. </p>\r\n<p> A través del sitio web de ITPC Barcelona, ​​los exportadores de Indonesia podían ofrecer sus productos a los compradores extranjeros y del otro lado; los compradores pueden encontrar buenos proveedores de productos de las empresas de Indonesia. Todos estos servicios e instalaciones son gratuitos para todos. </p>', NULL, NULL, 1, '2021-04-20 22:00:20', 1, '2021-03-19 16:47:16'),
(5, 'about_key-1615518208', '<ul> <li>Provide facility for Marketing of Indonesian export products and enhancement of the trade mission in the accredited countries</li> <li>Provide facility for Development of the business contacts and cooperation between Indonesian business council and the business communities in the accredited countries (business matching)</li> <li>Provide the business information and market opportunities in host countries and assist Indonesian business community about potential products in overseas markets</li> <li>Provide the information services on the potential export products to the foreign buyers</li> <li>Undertake the market analysis and improving business Intelligence and networking with business communities in host countries</li> <li>Disseminating information to the Spanish business communities;</li> <li>Prepare the work program and budgets as well as administrative and financial duties corresponding to the existing regulation</li> </ul>', '<ul> <li> Menyediakan fasilitas untuk Pemasaran produk ekspor Indonesia dan peningkatan misi dagang di negara-negara yang terakreditasi </li> <li> Menyediakan fasilitas untuk Pengembangan kontak bisnis dan kerjasama antara Dewan Bisnis Indonesia dengan dunia usaha di negara terakreditasi (business matching) </li> <li> Memberikan informasi bisnis dan peluang pasar di negara tuan rumah serta membantu komunitas bisnis Indonesia tentang produk potensial di pasar luar negeri </li> <li> Menyediakan layanan informasi mengenai potensi ekspor produk ke pembeli asing </li> <li> Melakukan analisis pasar dan meningkatkan Business Intelligence dan membangun jaringan dengan komunitas bisnis di negara tuan rumah </li> <li> Menyebarluaskan informasi ke komunitas bisnis Spanyol; </li> <li> Menyiapkan program kerja dan anggaran serta tugas administrasi dan keuangan sesuai ketentuan yang berlaku </li> </ul>', '<ul> <li> Facilitar la comercialización de productos de exportación indonesios y mejorar la misión comercial en los países acreditados </li> <li> Facilitar el desarrollo de los contactos comerciales y la cooperación entre el consejo empresarial de Indonesia y las comunidades empresariales en los países acreditados (correspondencia comercial) </li> <li> Proporcionar información comercial y oportunidades de mercado en los países anfitriones y ayudar a la comunidad empresarial de Indonesia sobre productos potenciales en los mercados extranjeros </li> <li> Proporcionar servicios de información sobre la exportación potencial productos a los compradores extranjeros </li> <li> Realizar el análisis de mercado y mejorar la inteligencia empresarial y la creación de redes con las comunidades empresariales en los países anfitriones </li> <li> Difundir información a las comunidades empresariales españolas; </li> <li> Elaborar el programa de trabajo y los presupuestos, así como las tareas administrativas y financieras correspondientes a la normativa vigente </li> </ul>', NULL, NULL, 1, '2021-04-20 22:00:20', 1, '2021-03-19 16:47:16'),
(6, 'about_key-1615518208', '<ul> <li>To boost the Indonesian non oil and gas export development to the Spain through market penetration, information, dissemination, trade inquiry services, expanding the business contacts between Indonesian exporters and Spanish importers, and active participation in various trade exhibition in Spain.</li> <li>To assist Indonesian companies in participating trade shows throughout the Spain.</li> <li>Promoting international trade by providing trade inquiry services to Indonesian companies and Spanish companies.</li> <li>Matchmaking assistance, arranging the meeting between Indonesian exporters and Spanish importers.<br />Promoting Indonesian economic growth to enhance business contracts between Indonesian exporters and U.S. importers.</li> </ul>', '<ul> <li> Mendorong perkembangan ekspor nonmigas Indonesia ke Spanyol melalui penetrasi pasar, informasi, sosialisasi, layanan inquiry perdagangan, perluasan kontak bisnis antara eksportir Indonesia dan importir Spanyol, serta partisipasi aktif dalam berbagai pameran perdagangan di Spanyol. </li> <li> Untuk membantu perusahaan Indonesia dalam berpartisipasi dalam pameran dagang di seluruh Spanyol. </li> <li> Mempromosikan perdagangan internasional dengan menyediakan layanan pertanyaan perdagangan kepada perusahaan Indonesia dan perusahaan Spanyol. </li> <li> Bantuan perjodohan, mengatur pertemuan antara eksportir Indonesia dan importir Spanyol. <br /> Mendorong pertumbuhan ekonomi Indonesia untuk meningkatkan kontrak bisnis antara eksportir Indonesia dan importir AS. </li> </ul>', '<ul> <li> Impulsar el desarrollo de las exportaciones indonesias de gas y petróleo a España a través de la penetración del mercado, la información, la difusión, los servicios de consulta comercial, la ampliación de los contactos comerciales entre los exportadores indonesios y los importadores españoles, y la participación activa en diversas exposiciones comerciales en España. </li> <li> Ayudar a las empresas indonesias a participar en ferias comerciales en toda España. </li> <li> Promover el comercio internacional mediante la prestación de servicios de consulta comercial a empresas indonesias y españolas. </li> <li> Asistencia de emparejamiento, organización de la reunión entre exportadores indonesios e importadores españoles. <br /> Promoción del crecimiento económico de Indonesia para mejorar los contratos comerciales entre exportadores indonesios e importadores estadounidenses. </li> </ul>', NULL, NULL, 1, '2021-04-20 22:00:20', 1, '2021-03-19 16:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `short_translations`
--

CREATE TABLE `short_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `trans_key` varchar(50) NOT NULL,
  `english` varchar(255) DEFAULT NULL,
  `bahasa` varchar(255) DEFAULT NULL,
  `spanyol` varchar(255) DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `short_translations`
--

INSERT INTO `short_translations` (`id`, `trans_key`, `english`, `bahasa`, `spanyol`, `deleted_by`, `deleted_at`, `updated_by`, `updated_at`, `created_by`, `created_at`) VALUES
(1, 'news_key-1615517813', 'sadsad asqwert', 'asdsad asdsad', 'asdsad asdsadsa asdsad', NULL, NULL, 1, '2021-03-12 03:56:53', 1, '2021-03-12 03:56:53'),
(2, 'news_key-1615518151', 'sadsad asqwert 2', 'asdsad asdsad 2', 'asdsad asdsadsa asdsad 2', NULL, NULL, 1, '2021-03-12 04:02:31', 1, '2021-03-12 04:02:31'),
(3, 'news_key-1615518208', 'sadsad asqwert 2', 'asdsad asdsad 2', 'asdsad asdsadsa asdsad 2', NULL, NULL, 1, '2021-03-12 04:03:28', 1, '2021-03-12 04:03:28'),
(4, 'contact_key-1615518208', '<p>Calle Aribau 250 Bj.08006<br />Barcelona, Spain<br /><a href=\"mailto:info@itpc-barcelona.es\">info@itpc-barcelona.es</a><br />tel. +34 934 144 662<br />fax. +34 934 146 188</p>\r\n<p>whatsapp : +34 679 573 780 &nbsp;&ndash; &nbsp;LINE ID&nbsp;: itpcbarcel', '<p> Calle Aribau 250 Bj.08006 <br /> Barcelona, Spanyol <br /> <a href=\"mailto:info@itpc-barcelona.es\"> info@itpc-barcelona.es </a> <br / > tel. +34 934 144 662 <br /> fax. +34 934 146188 </p>\r\n<p> whatsapp: +34 679 573 780 & nbsp; & ndash; & nbsp; ID LIN', '<p> Calle Aribau 250 Bj.08006 <br /> Barcelona, España <br /> <a href=\"mailto:info@itpc-barcelona.es\"> info@itpc-barcelona.es </a> <br / > tel. +34934144662 <br /> fax. +34934146188 </p>\r\n<p> whatsapp: +34 679 573 780 & nbsp; & ndash; & nbsp; ID DE LÍNEA ', NULL, NULL, 1, '2021-03-23 17:47:29', 1, '2021-03-23 17:47:18'),
(5, 'about_key-1615518208', 'Indonesian Trade Promotion Centre, Barcelona', 'Pusat Promosi Perdagangan Indonesia, Barcelona', 'Centro de Promoción Comercial de Indonesia, Barcelona', NULL, NULL, 1, '2021-04-20 21:58:48', 1, '2021-04-20 21:58:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itpc_about`
--
ALTER TABLE `itpc_about`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `itpc_contact`
--
ALTER TABLE `itpc_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `long_translations`
--
ALTER TABLE `long_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `short_translations`
--
ALTER TABLE `short_translations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itpc_about`
--
ALTER TABLE `itpc_about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `long_translations`
--
ALTER TABLE `long_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `short_translations`
--
ALTER TABLE `short_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
