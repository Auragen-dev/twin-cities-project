-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 10:43 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cities_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) DEFAULT NULL,
  `category_icon` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`category_id`, `category_name`, `category_icon`) VALUES
(1, 'Music venue', ''),
(2, 'City Hall', ''),
(3, 'Cathedral', ''),
(4, 'Stadium', ''),
(5, 'Observatory', ''),
(6, 'Museum', ''),
(7, 'Art Gallery', ''),
(8, 'Planetarium', ''),
(9, 'Zoo', ''),
(10, 'Castle', ''),
(11, 'Cultural heritage site', '');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(8) NOT NULL,
  `country_name` varchar(20) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `woeid` varchar(10) DEFAULT NULL,
  `currency` varchar(15) DEFAULT NULL,
  `region` varchar(25) DEFAULT NULL,
  `time_zone` varchar(5) DEFAULT NULL,
  `area` decimal(4,1) DEFAULT NULL,
  `postal_code` varchar(6) DEFAULT NULL,
  `city_lat` decimal(12,5) NOT NULL,
  `city_long` decimal(12,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `country_name`, `population`, `woeid`, `currency`, `region`, `time_zone`, `area`, `postal_code`, `city_lat`, `city_long`) VALUES
(1, 'Leeds', 'England', 793139, 'UKXX0078', 'Pound sterling', 'Yorkshire and the Humber', 'UTC+0', '551.7', 'LS', '53.79972', '-1.54917'),
(2, 'Brno', 'Czech Republic', 381346, 'EZXX1255', 'Czech koruna', 'Central Bohemian', 'UTC+1', '230.1', '273 54', '49.19436', '16.60835');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_enrty` varchar(100) NOT NULL,
  `comment_username` varchar(40) NOT NULL,
  `comment_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `city_id` int(11) DEFAULT NULL,
  `place_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `flickr`
--

CREATE TABLE `flickr` (
  `flickr_id` int(11) NOT NULL,
  `flickr_photo` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `photo_id` int(11) NOT NULL,
  `place_id` int(11) DEFAULT NULL,
  `photo_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`photo_id`, `place_id`, `photo_name`) VALUES
(1, 1, 'Town_Hall.jpg'),
(2, 2, 'Elland_Road.jpg'),
(3, 3, 'The_Tetley.jpg'),
(4, 4, 'O2_Academy_Leeds.jpg'),
(5, 5, 'Harewood_House.jpg'),
(6, 6, 'Kirkstall_Abbey.jpg'),
(7, 7, 'Stpeter_Stpaul.jpg'),
(8, 8, 'Villa_Tugendhat.jpg'),
(9, 9, 'Spilberk_Castle.jpg'),
(10, 10, 'Technical_Museum.jpg'),
(11, 11, 'planet.jpg'),
(12, 12, 'ZOO_Brno.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(45) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `place_lat` decimal(12,5) NOT NULL,
  `place_long` decimal(12,5) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `wplink` varchar(250) NOT NULL,
  `wpimg` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`place_id`, `place_name`, `capacity`, `city_id`, `place_lat`, `place_long`, `des`, `wplink`, `wpimg`) VALUES
(1, 'Leeds Town Hall', 1550, 1, '53.80009', '-1.54970', 'Leeds Town Hall is a 19th century municipal building on The Headrow (formerly Park Lane), Leeds, West Yorkshire, England. Planned to include law courts, a council chamber, offices, a public hall, and a suite of ceremonial rooms, it was built between 1853 and 1858 to a design by the architect Cuthbert Brodrick. With the building of the Civic Hall in 1933, some of these functions were relocated, and after the construction of the Leeds Crown Court in 1993, the Town Hall now serves mainly as a concert, conference and wedding venue, its offices still used by some council departments. It was designated a Grade I listed building in 1951. ', 'https://en.wikipedia.org/wiki/Leeds_Town_Hall', 'https://en.wikipedia.org/wiki/Leeds_Town_Hall#/media/File:Leeds_Town_Hall_(geograph_5671640).jpg'),
(2, 'Elland Road', 1550, 1, '53.77831', '-1.57204', 'Elland Road is a football stadium in Leeds, West Yorkshire, England, which has been the home of Leeds United since the club\'s formation in 1919. The stadium is the 14th largest football stadium in England. The ground has hosted FA Cup semi-final matches as a neutral venue, and England international fixtures, and was selected as one of eight Euro 96 venues. Elland Road was used by rugby league club Hunslet in the mid-1980s and hosted two matches of the 2015 Rugby World Cup. ', 'https://en.wikipedia.org/wiki/Elland_Road', 'https://en.wikipedia.org/wiki/Elland_Road#/media/File:ELLAND_ROAD_STADIUM_X.jpg'),
(3, 'The Tetley', 40374, 1, '53.79218', '-1.53972', 'The Tetley, is a contemporary art gallery based to the south of the centre of Leeds, England, on the site for the former Tetley\'s Brewery. The gallery was opened on Friday 28 November 2013. Aire Park, a 2 hectares (4.9 acres) new public open space and redevelopment, is now being planned for the site surrounding the Tetley as part of the regeneration of the South Bank of Leeds.', 'https://en.wikipedia.org/wiki/The_Tetley,_Leeds', 'https://en.wikipedia.org/wiki/The_Tetley,_Leeds#/media/File:The_Tetley_4_August_2018_1.jpg'),
(4, 'O2 Academy Leeds', 2300, 1, '53.80237', '-1.54721', 'The O2 Academy Leeds (formerly known as the Town and Country Club)is a music venue situated in Leeds. It is run by the Academy Music Group, which has other music venues around the UK. The Academy was nominated for the TPi Awards 2010 for the country\'s favourite venue.', 'https://en.wikipedia.org/wiki/O2_Academy_Leeds', 'https://en.wikipedia.org/wiki/O2_Academy_Leeds#/media/File:O2_Academy,_Leeds_002.jpg'),
(5, 'Harewood House', 150, 1, '53.89696', '-1.52833', 'Harewood House is a country house in Harewood, West Yorkshire, England. Designed by architects John Carr and Robert Adam, it was built, between 1759 and 1771, for Edwin Lascelles, 1st Baron Harewood, a wealthy West Indian plantation and slave-owner. The landscape was designed by Lancelot \"Capability\" Brown and spans 1,000 acres (400 ha) at Harewood. ', 'https://en.wikipedia.org/wiki/Harewood_House', 'https://en.wikipedia.org/wiki/Harewood_House#/media/File:Harewood_House,_seen_from_the_garden.JPG'),
(6, 'Kirkstall Abbey', 500, 1, '53.82115', '-1.60671', 'Kirkstall Abbey is a ruined Cistercian monastery in Kirkstall, north-west of Leeds city centre in West Yorkshire, England. It is set in a public park on the north bank of the River Aire. It was founded c. 1152. It was disestablished during the Dissolution of the Monasteries under Henry VIII. The picturesque ruins have been drawn and painted by artists such as J.M.W. Turner, Thomas Girtin and John Sell Cotman. ', 'https://en.wikipedia.org/wiki/Kirkstall_Abbey', 'https://en.wikipedia.org/wiki/Kirkstall_Abbey#/media/File:Kirkstall_Abbey_in_the_late_afternoon.jpg'),
(7, 'Cathedral of St. Peter and St. Paul', 3000, 2, '49.19112', '16.60731', 'The Cathedral of Saints Peter and Paul is located on the Petrov hill in the centre of the city of Brno in the Czech Republic. It is a national cultural monument and one of the most important pieces of architecture in South Moravia. The interior is mostly Baroque in style, while the impressive 84-metre-high towers were constructed to the Gothic Revival designs of the architect August Kirstein in 1904–5. ', 'https://en.wikipedia.org/wiki/Cathedral_of_St._Peter_and_Paul,_Brno', 'https://en.wikipedia.org/wiki/Cathedral_of_St._Peter_and_Paul,_Brno#/media/File:Brno-Cathedral_of_St._Peter_and_Paul_2.jpg'),
(8, 'Villa Tugendhat', 30, 2, '49.20722', '16.61583', 'Villa Tugendhat is an architecturally significant building in Brno, Czech Republic. It is one of the pioneering prototypes of modern architecture in Europe, and was designed by the German architects Ludwig Mies van der Rohe and Lilly Reich. Built of reinforced concrete between 1928 and 1930 for Fritz Tugendhat and his wife Greta, the villa soon became an icon of modernism. ', 'https://en.wikipedia.org/wiki/Villa_Tugendhat', 'https://en.wikipedia.org/wiki/Villa_Tugendhat#/media/File:Vila_Tugendhat_exterior_Dvorak2.JPG'),
(9, 'Spilberk Castle', 1500, 2, '49.19428', '16.59891', 'Špilberk Castle (German: Spielberg, locally Špilas) is a castle on the hilltop in Brno, Southern Moravia. Its construction began as early as the first half of the 13th century by the Přemyslid kings and complete by King Ottokar II of Bohemia. From a major royal castle established around the mid-13th century, and the seat of the Moravian margraves in the mid-14th century, it was gradually turned into a huge baroque citadel considered the harshest prison in the Austrian Empire, and then into barracks. This prison had always been part of the Špilberk fortress and is frequently referenced by the main character, Fabrizio, in Stendahl\'s novel, \"The Charterhouse of Parma.\" ', 'https://en.wikipedia.org/wiki/%C5%A0pilberk_Castle', 'https://en.wikipedia.org/wiki/%C5%A0pilberk_Castle#/media/File:%C5%A0pilberk_(02).jpg'),
(10, 'Brno Technical Museum', 800, 2, '49.22805', '16.58138', 'Technické muzeum v Brně (TMB) je česká státní muzejní instituce, založená v roce 1961 a zaměřená na historii vědy a techniky, především z území Moravy a Slezska. Jedná se o příspěvkovou organizaci, která je přímo řízena Ministerstvem kultury České republiky. Sídlí v Králově Poli v Brně. ', 'https://cs.wikipedia.org/wiki/Technick%C3%A9_muzeum_v_Brn%C4%9B', 'https://cs.wikipedia.org/wiki/Technick%C3%A9_muzeum_v_Brn%C4%9B#/media/Soubor:Brno,_Technick%C3%A9_muzeum_v_Brn%C4%9B_(2412).jpg'),
(11, 'Brno Observatory and Planetarium', 150, 2, '49.20461', '16.58381', 'Hvězdárna a planetárium Brno je příspěvková organizace statutárního města Brna, jejíž historie sahá do 50. let 20. století. Tato kulturně-vzdělávací instituce, která v sobě spojuje hvězdárnu a planetárium, zprovozněné v roce 1954, sídlí v areálu uprostřed parku na kopci Kraví hora na severozápadě městské části Brno-střed v nadmořské výšce 305 m n. m. Vrchol kopule planetária, který se nachází v nadmořské výšce 318 m n. m., je nejvýše položeným bodem v okruhu několika kilometrů. Ředitelem Hvězdárny a planetária Brno je od roku 2008 Jiří Dušek.', 'https://cs.wikipedia.org/wiki/Hv%C4%9Bzd%C3%A1rna_a_planet%C3%A1rium_Brno', 'https://cs.wikipedia.org/wiki/Hv%C4%9Bzd%C3%A1rna_a_planet%C3%A1rium_Brno#/media/Soubor:Hv%C4%9Bzd%C3%A1rna_a_planet%C3%A1rium_Brno_001.jpg'),
(12, 'Zoo Brno', 2500, 2, '49.23008', '16.53344', 'Brno Zoo, is a Czech zoo, located in Brno in Czech Republic. In 2000, Brno Zoo became member in World Association of Zoos and Aquariums (WZO). The zoo is involved in captive breeding of endangered species coordinated by the European Endangered Species Programme like the Sumatran tiger, giant Hispaniolan Galliwasp, Przewalski\'s horse, as well as locally threatened species like the Czech owl called the little owl, barn owl or rare rodent species the European ground squirrel and Eurasian beaver. ', 'https://en.wikipedia.org/wiki/Brno_Zoo', 'https://en.wikipedia.org/wiki/Brno_Zoo#/media/File:Pavilion_of_apes2,_ZOO_Brno.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `place_cat`
--

CREATE TABLE `place_cat` (
  `place_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `place_cat`
--

INSERT INTO `place_cat` (`place_id`, `category_id`) VALUES
(1, 1),
(1, 2),
(2, 4),
(3, 7),
(4, 1),
(4, 4),
(5, 11),
(6, 11),
(6, 6),
(7, 3),
(8, 11),
(9, 10),
(11, 8),
(11, 5),
(12, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tweet`
--

CREATE TABLE `tweet` (
  `tweet_id` int(11) NOT NULL,
  `tweet_entry` varchar(100) DEFAULT NULL,
  `twitter_username` varchar(20) DEFAULT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD UNIQUE KEY `city_id` (`city_id`),
  ADD KEY `comment_ibfk_2` (`place_id`);

--
-- Indexes for table `flickr`
--
ALTER TABLE `flickr`
  ADD PRIMARY KEY (`flickr_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD UNIQUE KEY `city_id` (`city_id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`photo_id`),
  ADD UNIQUE KEY `place_id` (`place_id`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`place_id`,`city_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `place_cat`
--
ALTER TABLE `place_cat`
  ADD KEY `category_id` (`category_id`) USING BTREE,
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`tweet_id`),
  ADD UNIQUE KEY `city_id` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `flickr`
--
ALTER TABLE `flickr`
  MODIFY `flickr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `place_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `place_cat`
--
ALTER TABLE `place_cat`
  ADD CONSTRAINT `cat_place_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `place_cat_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `cat` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
