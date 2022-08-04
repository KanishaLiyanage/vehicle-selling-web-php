-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2022 at 07:55 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `admin_id` int(2) NOT NULL,
  `admin_username` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`admin_id`, `admin_username`, `admin_email`, `admin_password`, `is_deleted`) VALUES
(1, 'KanishaL', 'admin@gmail.com', '123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `count_item` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `product_id`, `count_item`, `is_deleted`) VALUES
(1, 3, 2, 1, 0),
(2, 3, 1, 1, 0),
(3, 3, 3, 1, 0),
(4, 3, 4, 1, 0),
(5, 3, 15, 1, 0),
(6, 1, 12, 1, 0),
(7, 1, 5, 1, 0),
(8, 2, 1, 1, 0),
(9, 2, 15, 1, 0),
(12, 2, 2, 1, 0),
(15, 2, 8, 1, 0),
(16, 4, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `username`, `email`, `password`, `mobile_number`, `address`, `postal_code`, `city`, `province`, `country`, `image`, `last_login`, `is_deleted`) VALUES
(1, 'KanishaL', 'kanisha@gmail.com', '123', '0713038084', '221/B, Baker Street, London, UK.', '221BLUK', 'London', 'LondonGB', 'UK', 'CUSTOMER_IMG-62d4484135e4a7.96745383.jpg', '2022-07-18 11:40:50', 0),
(2, 'Heisenberg', 'heisenberg@gmail.com', '123', '0713038084', '308 Negra Arroyo Lane, Albuquerque, New Mexico, United States.', '308ALBQM', 'Albuquerque', 'New Mexico', 'USA', 'CUSTOMER_IMG-62d653cb81eed6.06681721.jpg', '2022-07-19 06:48:43', 0),
(3, 'Batman', 'darkknight@jl.com', 'imbatman', '0713038084', 'Wayne Tower, Gotham City, USA.', 'WYNGCAK', 'Gotham', 'Arkham', 'USA', 'CUSTOMER_IMG-62d543f1188ff4.47641459.jpg', '2022-07-18 11:46:26', 0),
(4, 'robbin', 'robbin@gmail.com', '123', '0713038084', '.', '.', '.', '.', '.', 'CUSTOMER_IMG-62dd15a20fc854.38818802.jpg', '2022-07-24 09:49:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `favorites_count` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favorite_id`, `customer_id`, `product_id`, `favorites_count`, `is_deleted`) VALUES
(1, 3, 15, 1, 0),
(2, 1, 1, 1, 0),
(3, 1, 9, 1, 0),
(4, 1, 5, 0, 0),
(5, 1, 18, 1, 0),
(6, 2, 4, 1, 0),
(8, 2, 2, 0, 1),
(9, 2, 1, 1, 0),
(10, 2, 5, 1, 0),
(11, 2, 3, 1, 0),
(12, 2, 6, 1, 0),
(13, 4, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `order_qty` int(10) NOT NULL,
  `order_price` double NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `product_id`, `order_qty`, `order_price`, `created_time`, `is_deleted`) VALUES
(1, 3, 3, 2, 82900, '2022-07-18 23:32:54', 0),
(2, 3, 8, 1, 319995, '2022-07-19 00:20:23', 0),
(3, 3, 7, 1, 410580, '2022-07-19 00:25:24', 0),
(4, 3, 10, 1, 54235, '2022-07-19 00:37:02', 0),
(5, 1, 8, 1, 319995, '2022-07-19 05:59:44', 0),
(6, 1, 7, 1, 410580, '2022-07-19 05:59:34', 0),
(7, 1, 11, 1, 75000, '2022-07-19 00:46:52', 0),
(8, 1, 17, 1, 114600, '2022-07-19 00:47:01', 0),
(9, 1, 1, 2, 412590, '2022-07-19 05:59:25', 0),
(10, 1, 4, 4, 590000, '2022-07-19 05:56:23', 0),
(11, 1, 2, 1, 54900, '2022-07-19 03:24:27', 0),
(12, 2, 10, 2, 108470, '2022-07-19 11:15:57', 1),
(13, 2, 8, 1, 319995, '2022-07-19 11:15:58', 1),
(14, 2, 1, 4, 825180, '2022-07-19 11:17:33', 1),
(15, 2, 2, 1, 54900, '2022-07-19 11:18:10', 1),
(16, 2, 2, 3, 164700, '2022-07-19 11:21:56', 1),
(17, 2, 2, 8, 439200, '2022-07-19 11:23:37', 1),
(18, 2, 2, 4, 219600, '2022-07-19 11:23:38', 1),
(19, 2, 2, 4, 219600, '2022-07-19 11:28:41', 1),
(20, 2, 4, 5, 737500, '2022-07-19 11:28:59', 1),
(21, 2, 1, 1, 206295, '2022-07-21 06:57:22', 1),
(22, 2, 15, 1, 74555, '2022-07-20 05:16:00', 0),
(23, 2, 1, 1, 195980.25, '2022-07-21 06:57:52', 1),
(24, 2, 2, 1, 54900, '2022-07-21 06:56:58', 0),
(25, 2, 1, 1, 195980.25, '2022-07-21 06:58:07', 0),
(26, 2, 1, 1, 195980.25, '2022-07-21 07:02:01', 0),
(27, 2, 2, 1, 54900, '2022-07-21 07:02:20', 0),
(28, 4, 1, 1, 185665.5, '2022-07-25 05:26:27', 0),
(29, 4, 1, 1, 185665.5, '2022-07-25 12:44:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `product_brand` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `discount` double NOT NULL,
  `product_description` longtext NOT NULL,
  `qty` int(10) NOT NULL,
  `product_img` text NOT NULL,
  `purchases` int(10) NOT NULL,
  `ratings` float NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_brand`, `product_name`, `price`, `discount`, `product_description`, `qty`, `product_img`, `purchases`, `ratings`, `is_deleted`) VALUES
(1, 'Lamborghini', 'Huracán', 206295, 10, 'The 2022 Lamborghini Huracán draws everyone\'s attention, but it\'s the way it assaults the driver\'s senses that makes it special. The main attraction is the 600-plus-hp naturally aspirated V-10 that is mounted in the middle of the exotic-looking Lamborghini. The engine sounds magnificent when revved to its lofty redline, and it helps deliver hilariously quick acceleration. The Huracán can be configured as a coupe or as the Spyder convertible, and both offer rear- or all-wheel drive. While the only way to truly unlock the full potential of its incredible performance is to go to a racetrack, its ride is surprisingly civil when driven on public roads. Just don\'t expect the Lambo to be a great travel companion due to its limited interior cubby storage. Otherwise, the 2022 Huracán has all the hallmarks of supercar stardom—including a six-figure price tag.', 3, 'PRODUCT_IMG-62d439eadb1a20.73466461.png', 0, 0, 0),
(2, 'Audi', 'A6', 54900, 0, 'The Audi A6 has 1 Petrol Engine on offer. The Petrol engine is 1984 cc . It is available with Automatic transmission. Depending upon the variant and fuel type the A6 has a mileage of 14.11 kmpl & Ground clearance of A6 is 165mm. The A6 is a 5 seater 4 cylinder car and has length of 4939mm, width of 2110mm and a wheelbase of 2924mm.', 22, 'PRODUCT_IMG-62d43c82b36d63.83211050.png', 0, 0, 0),
(3, 'BMW', '3 Series', 41450, 0, 'The BMW 3 Series is a line of compact executive cars manufactured by the German automaker BMW since May 1975. It is the successor to the 02 Series and has been produced in seven different generations.\r\n\r\nThe first generation of the 3 Series was only available as a 2-door saloon; however, the model range has since expanded to include a 4-door saloon, 2-door convertible, 2-door coupé, 5-door estate, 5-door liftback (\"Gran Turismo\") and 3-door hatchback body styles. Since 2013, the coupé and convertible models have been marketed as the 4 Series; therefore, the 3 Series range no longer includes these body styles.\r\n\r\nThe 3 Series is BMW\'s best-selling model, accounting for around 30% of the BMW brand\'s annual total sales (excluding motorbikes), and has won numerous awards throughout its history.', 10, 'PRODUCT_IMG-62d43cc227b767.70340838.png', 0, 0, 0),
(4, 'BMW', 'i8', 147500, 3, 'The BMW i8 is a plug-in hybrid sports car developed by BMW. The i8 was part of BMW\'s electrified fleet and was marketed under the BMW i sub-brand. The production version of the BMW i8 was unveiled at the 2013 Frankfurt Motor Show and was released in Germany in June 2014.[12] Deliveries to retail customers in the U.S. began in August 2014.[13] A roadster variant was launched in May 2018.[14] Production ended in June 2020.\r\nThe 2015 BMW i8 accelerated from 0 to 100 km/h (62 mph) in 4.4 seconds and had an electronically limited top speed of 250 km/h (155 mph). The 2015 model year i8 had a 7.1-kWh lithium-ion battery pack that delivered an all-electric range of 37 km (23 mi) under the New European Driving Cycle. Under the U.S. EPA cycle, the range in EV mode was 24 km (15 mi). The battery capacity of both the BMW i8 Roadster and the i8 Coupe was increased to 11.6 kWh in 2018, allowing the NEDC electric range to rise to 55 km (34 mi) for the coupé and 53 km (33 mi) for the roadster.[6]\r\n\r\nThe BMW i8 coupé had a fuel efficiency of 2.1 L/100 km (134.5 mpg‑imp; 112.0 mpg‑US) under the NEDC test with carbon emissions of 49 g/km. The EPA rated the i8 combined fuel economy at 76 MPGe (3.1 L gasoline-equivalent/100 km; 91 mpg-imp gasoline-equivalent) and 29 miles per gallon (6.7L/100 km) when running in pure gasoline mode.[8]\r\n\r\nBy March 2020, global sales of all variants had reached more than 20,000 units, making the BMW i8 the world\'s top-selling plug-in electric sports car, and exceeding sales of all competitors in its segment combined.', 5, 'PRODUCT_IMG-62d43d41d2f297.10700809.png', 0, 0, 0),
(5, 'BMW', 'M3', 150500, 0, 'The BMW M3 is a high-performance version of the BMW 3 Series, developed by BMW\'s in-house motorsport division, BMW M GmbH. M3 models have been produced for every generation of 3 Series since the E30 M3 was introduced in 1986.\r\n\r\nThe initial model was available in a coupé body style, with a convertible body style added soon after. M3 Sedans were available during the E36 (1994–1999) and E90 (2008–2012) generations. Since 2014, the M3 has been solely produced in the sedan body style, due to the coupé and convertible models being rebranded as the 4 Series range, making the high-performance variant the M4.\r\n\r\nUpgrades over the regular 3 Series models include engines, handling, brakes, aerodynamics, lightweight materials and various interior upgrades. The M3\'s biggest contribution to both driver safety and the performance industry is BMW\'s continual development of their limited-slip differential, which mathematically maximizes torque and grip without compromising handling. The M3\'s most notable implementation of technology came in 1992 when the E36 M3 was outfitted with the SMG-I gearbox. When they fitted the E46 M3 with the SMG-II gearbox, it officially took the title as the fastest shifting gear box in the world. A carbon fiber air box was developed for the E46 M3 CSL, and it worked by creating a vortex of air that could constantly maintain maximum air induction pressure to maximize throttle response.', 6, 'PRODUCT_IMG-62d43d80e7c8d8.45001681.png', 0, 0, 0),
(6, 'Chevrolet', 'Camaro 2016', 36000, 0, 'The 2016 Camaro rides smoothly and feels planted on the road. Its steering is responsive and nicely weighted. Chevrolet’s optional Magnetic Ride Control suspension (available in Camaro SS models) adapts instantly to bumps in the road surface, providing an even smoother ride and sharper cornering. Powerful brakes bring the Camaro to a stop with confidence.\r\n\r\nThe Camaro comes standard with a six-speed manual transmission, rear-wheel drive, and a turbocharged four-cylinder engine with 275 horsepower. An eight-speed automatic is available. The small four-cylinder can move the Camaro from zero to 60 mph in just 5.4 seconds. The Camaro\'s available 335-horsepower V6 and 455- horsepower V8 only enhance these muscle car sensations. The V6 delivers lively acceleration and a snarling exhaust note, while the rumbling V8 cuts the car’s zero-to-60 dash time to just four seconds. The manual transmission feels crisp and precise, while the automatic exhibits prompt, seamless shifts.', 2, 'PRODUCT_IMG-62d43e4410df54.69117158.png', 0, 0, 0),
(7, 'Ferrari', '488 Spider', 410580, 0, 'The Ferrari 488 represents a new chapter in the history of Prancing Horse V8-powered supercars. It takes its inspiration from a classic Ferrari model designation — the 308 GTB and F40 — and the Ferrari 488’s specs showcase its world-class capability. As a return to the classic naming convention, there’s a nod to the past; but with up to 661 horsepower, this track-focused supercar blazes a trail into the future.\r\nThe 488 Spider might look like a topless version of Ferrari’s 488 GTB. The truth is, there is actually more to it than meets the eye. Here are some interesting bits of information that you should know about Ferrari’s latest V8 iteration. Get this car on hire from Luxury supercar hire in London.', 2, 'PRODUCT_IMG-62d43ed175d8a1.65847431.png', 0, 0, 0),
(8, 'Ferrari', 'F12 Berlinetta', 319995, 10, 'The 6.3L naturally aspirated 65° V12 makes the F12berlinetta one of the most powerful Ferrari road cars produced to this day, surpassed only by era-defining models like the LaFerrari and the 812 Superfast.\r\nWhile the head-turning exterior design and award-winning engine are the main draws to the F12, the interior ensures you’re in the highest comfort while behind the wheel. To enhance sportiness and efficiency, the F12 volumes were reduced, delivering a streamlined look in the cockpit with a racing-inspired driving position. Hand-executed detailing is balanced evenly with advanced technology features to give the F12 cabin an intuitive feel whether it’s your first or your hundredth time behind the wheel.', 3, 'PRODUCT_IMG-62d43f67e4d122.90324861.png', 0, 0, 0),
(9, 'Honda', 'Civic 2018', 20400, 0, 'The 2018 Civic is available in three body styles: a two-door coupe, a four-door sedan, and a four-door hatchback. All models have five seats except for the Type R, which seats four. The Civic\'s front seats are comfortable and supportive, and the driving position is relaxing even on longer road trips.\r\nBase engine: 2.0-liter four-cylinder with 158 horsepower\r\nAvailable engines:\r\n174-horsepower 1.5-liter turbo four-cylinder\r\n205-horsepower 1.5-liter turbo four-cylinder (Si model only)\r\n306-horsepower turbo 2.0-liter four-cylinder (Type R only)\r\nDrivetrain: front-wheel drive\r\nTransmission : standard six-speed manual; available continuously variable automatic (CVT)', 15, 'PRODUCT_IMG-62d4ddc38e9ef8.15380497.png', 0, 0, 0),
(10, 'Jeep', 'Grand Cherokee', 54235, 6, 'The Jeep Grand Cherokee is a range of mid-size SUVs produced by the American manufacturer Jeep.[2] At its introduction, while most SUVs were still manufactured with body-on-frame construction, the Grand Cherokee has used a unibody chassis from the start.\r\nThe Grand Cherokee\'s origins date back to 1983 when American Motors Corporation (AMC) was designing a successor to the smaller Jeep Cherokee (XJ). Three outside (non-AMC) designers—Larry Shinoda, Alain Clenet, and Giorgetto Giugiaro—were also under contract with AMC to create and build a clay model of the Cherokee XJ replacement, then known as the \"XJC\" project. However, the basic design for the Cherokee\'s replacement was well under way by AMC\'s in-house designers and the 1989 Jeep Concept 1 show car foretold the basic design.', 9, 'PRODUCT_IMG-62d44051b3e9d5.07042963.png', 0, 0, 0),
(11, 'Jeep', 'Wrangler', 75000, 0, 'The Jeep Wrangler is a series of compact and mid-size four-wheel drive off-road SUVs manufactured by Jeep since 1986, and currently in its fourth generation. The Wrangler JL, the most recent generation, was unveiled in late 2017 and is produced at Jeep\'s Toledo Complex.', 8, 'PRODUCT_IMG-62d44093756653.17215455.png', 0, 0, 0),
(12, 'Lamborghini', 'Aventador', 573966, 4, 'Revolutionary thinking is at the heart of every idea from Automobili Lamborghini. Whether it is aerospace-inspired design or technologies applied to the naturally aspirated V12 engine or carbon-fiber structure, going beyond accepted limits is part of our philosophy. The Aventador advances every concept of performance, immediately establishing itself as the benchmark for the super sports car sector. Giving a glimpse of the future today, it comes from a family of supercars already considered legendary.\r\nEach and every detail of the Aventador bears the hallmarks of the House of the Raging Bull. It is a true masterpiece of design that expresses dynamism and power, with the carbon-fiber monocoque the jewel in its crown. The interior combines high-level technology and luxury equipment, crafted by skilled artisans using.', 5, 'PRODUCT_IMG-62d440f75f8d63.45154337.png', 0, 0, 0),
(13, 'Mazda', 'Rx8', 18920, 0, 'The Mazda RX-8 is a sports car manufactured by Japanese automobile manufacturer Mazda between 2002 and 2012. It was first shown in 2001 at the North American International Auto Show. It is the successor to the RX-7[citation needed] and, like its predecessors in the RX range, it is powered by a rotary Wankel engine. The RX-8 was available for sale in North America from the 2003 model year.\r\nMazda announced on August 23, 2011, that the RX-8 was to be discontinued citing 2012 model year to be the last year of its availability. The RX-8 was removed from the European market in 2010 after the car failed to meet emissions standards.\r\nDue to falling sales from Europe coupled with rising Yen prices, Mazda could not justify the continued sale of the RX-8 in other markets.', 5, 'PRODUCT_IMG-62d4415cac7d56.81233522.png', 0, 0, 0),
(14, 'Mercedes Benz', 'CLA 200', 38200, 0, 'Mercedes-Benz CLA 200 returns a certified mileage of 17.9 kmpl. This 200 CDI Style variant comes with an engine putting out 134 bhp @ 3600 rpm and 300 Nm @ 1600 rpm of max power and max torque respectively.\r\n•    1,332cc, 4-cylinder, 120kW, 250Nm\r\n•    Direct-injection, turbocharged\r\n•    7G-DCT 7-speed automatic\r\n•    ECO start/stop\r\n•    Front wheel drive', 15, 'PRODUCT_IMG-62d441fa02dc22.95675541.png', 0, 0, 0),
(15, 'Ford', 'Mustang GT500', 74555, 4, 'The most powerful engine ever stuffed into a Ford production car lurks behind the Shelby GT500\'s menacing mug. Aptly called Predator, the motor is a supercharged 5.2-liter V-8 that summons 760 horsepower and 625 pound-feet of torque. That prodigious power twists the rear wheels through a clairvoyant seven-speed dual-clutch automatic transmission (sorry, the mightiest Mustang isn\'t offered with a manual transmission).', 9, 'PRODUCT_IMG-62d4424402db37.56644831.png', 0, 0, 0),
(16, 'Nissan', 'GTR', 113540, 10, 'The Nissan GT-R (Japanese: 日産・GT-R, Nissan GT-R), is a high-performance sports car and grand tourer produced by Nissan unveiled in 2007. It is the successor to the Skyline GT-R, a high performance variant of the Nissan Skyline. Although this car was the sixth-generation model to bear the GT-R name, the model is no longer part of the Nissan Skyline model lineup since that name is now reserved for Nissan\'s luxury-sport vehicles. The GT-R built on the exclusively developed Nissan PM platform, which is an enhanced evolution of the Nissan FM platform used in the separate Nissan Skyline luxury car and the Nissan Z sports car. The GT-R abbreviation stands for Gran Turismo–Racing, obtained from the Skyline GT-R.', 14, 'PRODUCT_IMG-62d4428e724f36.53956385.png', 0, 0, 0),
(17, 'Range Rover', 'Vogue', 114600, 0, 'The Range Rover Vogue comes with a raft of standard equipment, including full matrix LED headlights, a panoramic glass roof, auto lights and wipers, a heated steering wheel, full leather seats, a hands-free split power tailgate, a centre armrest cooler and a WiFi hotspot.\r\n\r\nOn top of that, the Vogue SE adds soft-close doors, LED ambient lighting inside, 360-degree parking cameras, heated and cooled electric seats in Aniline leather and 21-inch wheels, compared to 20-inches on the standard Vogue.', 3, 'PRODUCT_IMG-62d4de0a4686b4.76319863.png', 0, 0, 0),
(18, 'Tesla', 'Model S', 129990, 2, 'Model S is built from the ground up as an electric vehicle, with a high-strength architecture and floor-mounted battery pack for incredible occupant protection and low rollover risk. Every new Model S includes Tesla’s latest active safety features, such as Automatic Emergency Braking, at no extra cost. Autopilot enables your car to steer, accelerate and brake automatically within its lane under your active supervision, assisting with the most burdensome parts of driving. With over-the-air software updates, the latest enhancements are available instantly. ', 6, 'PRODUCT_IMG-62d4433180b5f9.65488386.png', 0, 0, 0),
(19, 'Toyota', 'Corolla Altis', 28360, 0, 'The Toyota Corolla Altis is a Sedan with 5 seater capacity. It is one of the best among various cars. Toyota Corolla Altis comes with Automatic Petrol and Manual Petrol/Diesel Engines. The Engine Displacement of the Petrol engine is 1798 cc. It comes with the Manual and Automatic Transmission.\r\n\r\nIt has a mileage of 14.28 kmpl to 21.43 kmpl based on the type of fuel and the variant. The length of Toyota Corolla Altis is 4620 mm, width is 1775 mm and a wheelbase of 2700 mm.\r\nToyota Corolla Altis has a maximum power of 138.03bhp@6400rpm and the maximum torque of 173Nm@4000rpm.', 18, 'PRODUCT_IMG-62d44384dd9400.98233806.png', 0, 0, 0),
(20, 'Toyota', 'Hilux', 70750, 0, 'The Toyota Hilux has 1 Diesel Engine on offer. The Diesel engine is 2755 cc . It is available with Manual & Automatic transmission. Depending upon the variant and fuel type the Hilux has a mileage of . The Hilux is a 5 seater 4 cylinder car and has length of 5325, width of 1855 and a wheelbase of 3085.\r\nFuel Type: Diesel\r\nEngine Displacement (cc): 2755\r\nBody Type: Pickup Truck', 7, 'PRODUCT_IMG-62d44466e40687.40937585.png', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `shipment_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `deliver_date` varchar(50) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`shipment_id`),
  ADD UNIQUE KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `admin_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `shipment_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
