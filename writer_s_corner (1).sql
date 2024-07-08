-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 01:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `writer's corner`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `birth_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `username`, `email`, `password`, `phone`, `image`, `birth_date`) VALUES
(22, 'أحمد خالد توفيق', 'ahmedkhaledtawfiq@gmail.com', '$2y$10$Hyzsf7nz3Xo1hsjbPLI8lOVTiAxLDEDr6cZdvA4A5A6WFGfBb9N.m', '01084925856', 'photo-1511367461989-f85a21fda167.avif', '1974-06-20'),
(23, 'حسن الجندي', 'hasanelgendy@gmail.com', '$2y$10$oHSAR7q2DLmS06dhPFz6weJXauahcGxMN1aodGgQiNWWWkzpdUH.2', '01184358695', 'photo-1511367461989-f85a21fda167.avif', '1973-02-24'),
(24, 'شيرين هنائي', 'sherinehanai@gmail.com', '$2y$10$Jb2I48EFVL1/JQrv5IGdbutAOb8wBXrozUkjR/Ru3KcJXifRRNLJ2', '01274658925', 'photo-1511367461989-f85a21fda167.avif', '1985-01-01'),
(25, 'عمرو المنوفي', 'amrelmenoufy@gmail.com', '$2y$10$Kz9EUL5TKgFnhV4At86qxeDBgbepBrSJzSbZExUobVMbIG1uLNvo6', '01187426589', 'photo-1511367461989-f85a21fda167.avif', '1980-05-12'),
(26, 'أحمد خالد مصطفى', 'ahmedkhaledmustafa@gmail.com', '$2y$10$2oNGFYO1oquq64lnEI4MzefYdkgZQiuQQTWqTUWlszaWEc5XQ9ZsW', '01232596100', 'photo-1511367461989-f85a21fda167.avif', '1979-04-18'),
(27, 'مريم الحيسي', 'maryamalhaisi@gmail.com', '$2y$10$AuCs3drH5mdeWudEG9SNtePsDlWV9KGtY2knjtN3l7CYwFH6iuKhy', '01245841000', 'photo-1511367461989-f85a21fda167.avif', '1990-06-12'),
(28, 'تامر إبراهيم', 'tameribrahim@gmail.com', '$2y$10$LpnBVIpuMGAEHE5xtGM83eDjQubX/Rp0Zwdzc4/GnL7sLvHcGaD9G', '01085964723', 'photo-1511367461989-f85a21fda167.avif', '1979-11-01'),
(29, 'ليو تولستوي', 'leotolstoy@gmail.com', '$2y$10$mwSLcVipGQOhBDOYQNUskuxnWgAzq3FP40tRGnpHnxbrriV0RxHQq', '01023584589', 'photo-1511367461989-f85a21fda167.avif', '1995-10-24'),
(30, 'تشارلز ديكينز', 'charlesdickens@gmail.com', '$2y$10$3aLKtCNP3rdZUSPA6sMM4.Ym0QPPrHkjsCYeovEJ1zE9Wgmdw3Qk.', '01147523685', 'photo-1511367461989-f85a21fda167.avif', '1970-07-18'),
(31, 'مصطفى لطفي المنفلوطي', 'mustafalotfialmanfaluti@gmail.com', '$2y$10$cZTGkgLWuaI1O1Yl4US30.wNhGTslxD1h.NQp1G97st86fh.UhfPm', '01125689478', 'photo-1511367461989-f85a21fda167.avif', '1966-06-13'),
(32, 'ميكا فالتري', 'mikavaltteri@gmail.com', '$2y$10$ZHS6BcbhYgoLlaMG5.URFun8KL7xpflN0oCIUP3ny3AsTtynfE7d2', '01184958256', 'photo-1511367461989-f85a21fda167.avif', '1973-06-12'),
(33, 'نرمين نحمد الله', 'nermin@gmail.com', '$2y$10$OKBMQmGj8Xv8HfOAI5u8ue3PjmVhXJtPwXHoLWWiM/W/1K/HVMsGu', '01296358489', 'photo-1511367461989-f85a21fda167.avif', '1982-07-18'),
(34, 'احمد آل حمدان', 'ahmedalhemdan@gmail.com', '$2y$10$o6.Ws5TCe448HbzHIqXen.bo0UvAhGKePlFwM0uXaE91PHDCUXEZS', '01074598629', 'photo-1511367461989-f85a21fda167.avif', '1976-10-09'),
(35, 'ساندرا سراج', 'sandrasiraj@gmail.com', '$2y$10$cD4KEIY.fD2xEOtw8pcg2OYf01/1SJCGC3lX4yHZt4vLILk/gJ/qC', '01148596357', 'photo-1511367461989-f85a21fda167.avif', '1986-10-20'),
(36, 'إسراء علي', 'IsraaAli@gmail.com', '$2y$10$NkjIYSrr3OmgIfdRV1iuGu4KTT5Pn80ktR7wGqNN/FYNYoXBMk2de', '01275395185', 'photo-1511367461989-f85a21fda167.avif', '1990-06-20'),
(37, 'عمرو عبد الحميد', 'AmrAbdelHamid@gmail.com', '$2y$10$KLnHSktY.hPaMZL2nxgw7ehlAiUSJAllPxY.tDn/5QnTgmuzWL/ze', '01298562571', 'photo-1511367461989-f85a21fda167.avif', '1987-05-12'),
(38, 'يوسف حسن', 'YoussefHassan@gmail.com', '$2y$10$PXarPDHREwW5PSNY3rbrBua.tQuYT5uHQ63JjCw8vkMQWm7peQYJ.', '01025841000', 'photo-1511367461989-f85a21fda167.avif', '1969-10-13'),
(39, 'محمد إبراهيم', 'MuhammadIbrahim@gmail.com', '$2y$10$j03TujNRJKQzgwvglnbzO.Q9fxWLyQK.022Mfivr2hiKeHpjumnY2', '01147259100', 'photo-1511367461989-f85a21fda167.avif', '1980-05-29'),
(40, 'عماد رشاد عثمان', 'ImadRashadOthman@gmail.com', '$2y$10$YzH9/JqdB3ATYAH0n96z9elI6bvNJPCg2fHukJsxH1nfmFW3WZNTS', '01222859648', 'photo-1511367461989-f85a21fda167.avif', '1984-09-07'),
(41, 'لوري غوتليب', 'LoriGottlieb@gmail.com', '$2y$10$AuCvJq7drmlpUHFznaqurOEe0NTdqs91iilRtdfSWUMDYdjzhA1Gi', '01145681000', 'photo-1511367461989-f85a21fda167.avif', '1988-09-14'),
(42, 'مارك مانسون', 'MarkManson@gmail.com', '$2y$10$zaYwLsMmNykzpMze0.fWouTnFibIqZzK7OPj1ig2DLYKutb8ZM9fm', '01245681200', 'photo-1511367461989-f85a21fda167.avif', '1989-08-17'),
(43, 'محمد طه', 'Mohamedtaha@gmail.com', '$2y$10$uHy4lHQN5IKmMtY8MUZ6EOEcvrG3QcImNRicjdlrGJ2W3SbeeAf/.', '01285476325', 'photo-1511367461989-f85a21fda167.avif', '1981-09-19'),
(44, 'روبرت غرين', 'RobertGreene@gmail.com', '$2y$10$IwTzUthEwWXpozEiy.XexOLb.lMJYViLyvTeBJWUcQCYb/jHpo61q', '01245857963', 'photo-1511367461989-f85a21fda167.avif', '1983-05-02'),
(45, 'سلامة موسى', 'SalamaMusa@gmail.com', '$2y$10$FsImaWHzHFsv5cXPjVW9AuUubNflziqmFpHDeSGrWXT91L51/ufLe', '01124589632', 'photo-1511367461989-f85a21fda167.avif', '1986-10-21'),
(46, 'جبران خليل جبران', 'GibranKhalil@gmail.com', '$2y$10$0frocmTzpzQGykAB9SKT1.hHW7Z54yN9ijyQf0ZietkTIdhCDmWIO', '01025963587', 'photo-1511367461989-f85a21fda167.avif', '1963-10-31'),
(47, 'ثروت عكاشة', 'TharwatOkasha@gmail.com', '$2y$10$rSvEQ169bk/Gfi7iP/1hFeVO3wLoUC/bzx2/5vPQUhDrasu764bXW', '01175891000', 'photo-1511367461989-f85a21fda167.avif', '1970-11-26'),
(48, 'جورج فيغاريلو', 'GeorgeFigarello@gmail.com', '$2y$10$NUsjSSREFGk/ZYGDZK/Gcui4P/Qu7fiTbO7CI0y7MWV.A1yMQCkeq', '01210005896', 'photo-1511367461989-f85a21fda167.avif', '1977-09-13'),
(49, 'أمبرتو إيكو', 'UmbertoEco@gmail.com', '$2y$10$U2p5WSvU6FqLt1Mv7q9qUOZOqxquL5lcBIISzlwbuxOjxWHQaskKC', '01110002495', 'photo-1511367461989-f85a21fda167.avif', '1968-05-10'),
(50, 'غازي القصيبي', 'GhaziAlgosaibi@gmail.com', '$2y$10$O8kjDphvzjd/gixZX94IEewxjnb44dIW5Ynd2WEZe2n9hlFI7YkXu', '01222789625', 'photo-1511367461989-f85a21fda167.avif', '1970-09-22'),
(51, 'Vikram Vaswani', 'VikramVaswani@gmail.com', '$2y$10$ozkBMZqqD0qqIyWws9U7/e7ZTnzEjIde.Xe9wBk.OsJPnPSRD02tO', '01027856000', 'photo-1511367461989-f85a21fda167.avif', '1989-10-15'),
(52, 'Matt Stauffer', 'MattStauffer@gmail.com', '$2y$10$Emb0Tszto46KJDui1lVTpuhr92m3CLz2ObI0lZgLJD7eyT.PGli0W', '01024859518', 'photo-1511367461989-f85a21fda167.avif', '1985-09-25'),
(53, 'Jennifer Niederst Robbins', 'JenniferNiederst@gmail.com', '$2y$10$OW3TMkSkVgG3qSC0ngLjKuCXsx9GP/7Ce1FwbZq9.Gg6GeV.Vxw0e', '01017400258', 'photo-1511367461989-f85a21fda167.avif', '1986-06-20'),
(54, 'Axel Rauschmayer', 'AxelRauschmayer@gmail.com', '$2y$10$Jd16B/1ErfnDfC8XL.hoG.OCXyzzpMp5tqe/X.y.X5fkFo1cDx9Dq', '01251203652', 'photo-1511367461989-f85a21fda167.avif', '1970-10-28'),
(55, 'Jason Gilmore', 'JasonGilmore@gmail.com', '$2y$10$c.dmPIIisngDINyzukk8H.dMBWlODkXsr/MhmjhR6CqM3mZPw1OES', '01121005858', 'photo-1511367461989-f85a21fda167.avif', '1984-06-15'),
(59, 'eyad eyad', 'eyadeyad@gmail.com', '$2y$10$H8Iqe2vrPeX4uAvyvfT.bupoz76R4nqsaBUd9C0FLzn6xlR41Hywq', '01010001000', 'photo-1511367461989-f85a21fda167.avif', '2024-06-11'),
(64, 'eyad waleed', 'eyadwaleed16@gmail.com', '$2y$10$VAIagSvTdD2BNU6e7zNVT.xHw3GT8CH6SbbdeXhb2GKxzL7OKnxrW', '01276866491', '2.png', '2015-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `publication_date` timestamp NULL DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `type` enum('paid','free') NOT NULL,
  `status` enum('accepted','pending','rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author_id`, `category_id`, `description`, `price`, `publication_date`, `image`, `file`, `type`, `status`) VALUES
(18, 'أسطورة الجاثوم', 22, 3, 'شكلة أبطال قصص الرعب هي أنهم يتصرفون بتهور مستفز .. يصرون – دون سبب واضح – على نزول القبو المليء بتوابيت مصاصي الدماء ليلا .. و يصرون – برغم نذر الخطر – على ارتياد الغابة المظلمة وحدهم.\r\n', 50.00, '2024-06-15 13:01:39', 'صورة واتساب بتاريخ 2024-06-15 في 01.06.04_676843c5.jpg', '79254.Foulabook.com.2018-02-20.1519131465.pdf', 'paid', 'accepted'),
(19, 'رواية الجزار', 23, 3, '“أنا من أتيت من أعماق عقلي…أنا الرغبة المجسدة…أنا من أردت أن أكونه ، و أخاف أن أكونه..أنا المسخ الذي عاد لكم”', 0.00, '2024-06-15 13:07:20', 'صورة واتساب بتاريخ 2024-06-15 في 01.06.25_d3cf451e.jpg', 'الجزار.pdf', 'free', 'accepted'),
(20, 'رواية نيكروفيليا', 24, 3, '“إنني لا أرى في البشر الأسود والأبيض فق، إنما هي مساحة رمادية يتراوح فيها البشر بين الرمادي الغامق والفاتح .. لا جناة هنا ولا أبرياء .. فقط البعض يبدأ بريئاً إلى أن ندفعه دفعاً إلى هاوية الإجرام .. وبعضنا مذنب .. طهرته نواتج أفعاله حتى انتهى به الطريق أقرب إلى القديسين .. !!”', 50.00, '2024-06-15 13:10:09', 'صورة واتساب بتاريخ 2024-06-15 في 01.07.06_268f7f34.jpg', 'نيكروفيليا.pdf', 'paid', 'accepted'),
(21, 'رواية الآن أفهم', 22, 3, '“سأعترف لك بشيء: أنا أمقت أكلة لحوم البشر.. إنهم سمجون يفتقرون لروح الدعابة، ولهم عادات غذائية مقززة نوعًا”', 50.00, '2024-06-15 13:12:43', 'صورة واتساب بتاريخ 2024-06-15 في 01.07.17_649820ac.jpg', 'الآن_أفهم.pdf', 'paid', 'accepted'),
(22, 'رواية سايكو', 25, 3, '“طفلتي الصغيرة تعلمت ان تطرق الأبواب ادبا”؛ و عندما طرقت باب التلاجة؛جاءها الصوت من الداخل ان تكف عن إزعاج النائمين! !؟” ', 55.00, '2024-06-15 13:19:35', 'صورة واتساب بتاريخ 2024-06-15 في 01.07.27_37287cf7.jpg', 'ktp2019-bk12240.pdf', 'paid', 'accepted'),
(23, 'أنتيخريستوس', 26, 3, 'قد أصبحنا وحدنا أخيرا .. أنا وأنت .. ‏\r\nأخيرا انفردت بك .. ‏\r\nوصرت أملكك .. وأملك عينيك .. في كل مرة تنظر فيها إلى كلماتي .. و تقرأ فيها سطوري .. ‏\r\nستكون هذه هي آخر رواية ستقرأها لي في حياتك .. فأنا على شفا حفرة من الموت .. ‏\r\nولم يتبق لي في هذه الحياة إلا سويعات لا أدري عددها .. لكنني أعرف أنها قليلة .. وبرغم ذلك فهي كافية لأسقيك بما أريد أن أسقيك إياه من ‏الحديث.‏\r\nقبل أن أبدأ أقول لك .. يجب أن تقرأ هذا الكتاب وتحرقه .. فسيحاولون التخلص منه ومن كل من قرأه .. كما فعلوا مع كل الكتب التي شابهته. ', 70.00, '2024-06-15 13:23:28', 'صورة واتساب بتاريخ 2024-06-15 في 01.07.56_73fefeb1.jpg', 'أنتيخريستوس_51909_Foulabook.com_.pdf', 'paid', 'accepted'),
(24, 'رواية إنني أتعفن رعبا', 27, 3, 'تتحدث الرواية عن شخصيتين رئيسيتين اولهم “ماريا” الشابة التي تعاني من مرض نفسي يسحبها الى رؤية كوابيس غير طبيعية وبمعدل فوق طاقة الانسان الطبيعي ، مما تجعل هذه الكوابيس تقلب حياتها رأسا على عقب ! تحاول ماريا السيطرة على كوابيسها وخصوصا الكوابيس التي تتكرر مرارا وتكرارا ورغم ذهابها الى جميع الاطباء والمعالجين وغيرهم الا انها لا تجد لا حلول ولا علاج في أي مكان ! لذلك تقترح عليها والدتها تجربة العلاج بالفن تقوم ماريا بتطبيق هذا العلاج بحذافيره وتبدا في رسم كوابيسها على لوحات وبالفعل الكوابيس تتوقف عن التكرار لكن لا تتوقف عن الظهور في عقلها ، تستمر ماريا برسم كوابيسها على اللوحات لمدة سنوات وتصبح رسامة مشهورة جدا وتقوم ببيع لوحاتها لعديد من الناس بـ أسعار باهضه ! حتى يأتي اليوم الذي يغير فيها حياة ماريا بشكل جذري ، عندما تخرج الكوابيس من اللوحات الى الارض الواقع وتبدا الكوابيس بأحداث جرائم قتل متسلسلة وكل شيء في اللوح يطبق بشكل متقن على الضحية لتصبح لوحة وكابوس واقعي!!؟ تحاول ماريا ان تسيطر على كوابيسها الطليقة بدون فائدة قبل ان تفقد عقلها وقبل ان تكون متهمة في سلسلة جرائم القتل لأنها الرسامة صاحبة لوحات الكوابيس !!فماذا يحدث لها وكيف ستنجو من الكوابيس في المنام والكوابيس في الواقع وكيف ستنجو من الوحوش التي هربت من لوحاتها !؟ ماريا التي لا تتذكر حتى طفولتها وكيف كانت ومن يكون والدها تصبح عالقة بين الكوابيس وسلسلة الجرائم التي تحدث بدون توقف ..!', 100.00, '2024-06-15 13:28:39', 'صورة واتساب بتاريخ 2024-06-15 في 01.10.13_a7fc95b8.jpg', 'innaniataafan-1.pdf', 'paid', 'accepted'),
(25, 'رواية حكايات الموتى', 28, 3, 'أنت تعرف ذلك الشعور .. حين يسير كل شىء وفقا لما تريد وحين تحصل على ماتبغيه وتحقق ماتصبوا إليه.. هذا لايحدث على أرض الواقع إلا في حالة واحدة فقط .. لو كانت كارث موشكة على الحدوث قريبا ! هدوء ماقبل العاصفة كما يسمونه .. لاتتجاهل هذا الأحساس أبدا لو شعرت به، فالحياة لاتمنح إلا لتأخذ ولاترضى عنك إلا لتثور فجأة وحين تفعل .. ترد لك الصاع بألف.', 50.00, '2024-06-15 14:48:11', 'صورة واتساب بتاريخ 2024-06-15 في 01.12.29_c9c4872c.jpg', 'حكايات الموتى.pdf', 'paid', 'accepted'),
(26, 'الحرب والسلام', 29, 4, 'تعد رواية الحرب والسلام للكاتب الروسي الغني عن التعريف ليو تولستوي واحدة من أفضل الروايات التاريخية عبر العصور. هناك أكثر من 500 شخصية تاريخية ومخترعة مدرجة في حبكتها لتطوير القصص المتعلقة بحياة خمس عائلات أرستقراطية روسية عاشت عام 1812 في ظل غزو القوات الفرنسية بقيادة نابليون بونابرت لروسيا. لكن على الرغم من طول الرواية وكثرة شخصياتها إلا أنها واحدة من الروايات التي ينبغي على أي محب للتاريخ والأدب القيم قراءتها.', 70.00, '2024-06-15 13:37:24', 'صورة واتساب بتاريخ 2024-06-15 في 01.30.52_02739cf3.jpg', 'الحرب والسلام_Foulabook.com_.pdf', 'paid', 'accepted'),
(27, 'قصة مدينتين', 30, 4, 'رواية قصة مدينتين هي الرواية التاريخية الثانية التي كتبها الكاتب الإنجليزي الكبير تشارلز ديكينز. وتدور أحداثها بين إنجلترا وفرنسا خلال الثورة الفرنسية. ولا تزال رائعة ديكينز هذه تُدرّس في عدد كبير من المدارس نظراً لقيمتها التاريخية والأدبية الكبيرة. لذا من الضروري للقارئ العربي كذلك المرور عليها.', 70.00, '2024-06-15 13:42:52', 'صورة واتساب بتاريخ 2024-06-15 في 01.31.04_b1fcca9c.jpg', 'قصة مدينتين_Foulabook.com_.pdf', 'paid', 'accepted'),
(28, 'في سبيل التاج', 31, 4, 'هذه الرواية واحدة من أفضل الروايات التاريخية التي ينبغي قراءتها. نظراً لأن من نقلها إلى العربية هو نابغة الإنشاء والكاتب النبيل مصطفى لطفي المنفلوطي صاحب القلم الفريد. هذه الرواية في الأصل هي مسرحية شعرية فرنسية للكاتب فرانسوا كوبيه تدور أحداثها في القرن الرابع عشر حول ثورة البلقان ورفضها لسلطة الإمبراطورية العثمانية. بطل الرواية هو الشاب قسطنطين الذي يقع في حيرة بين حبه لوطنه وبين حبه لعائلته.', 60.00, '2024-06-15 13:45:49', 'صورة واتساب بتاريخ 2024-06-15 في 01.31.19_906d8c63.jpg', '92496.Foulabook.com.2018-03-03.1520101984.pdf', 'paid', 'accepted'),
(29, 'سنوحي المصري', 32, 4, 'إذا كنا نتحدث عن أفضل الروايات التاريخية لا يمكننا تجاهل رواية سنوحي المصري للكاتب الفنلندي ميكا فالتري، فهي واحدة من الروايات الأكثر مبيعاً في حقبة الخمسينيات. كما يعد هذا العمل بالنسبة للعديد من القراء والنقاد مرجعاً إلزامياً لهذا النوع من الروايات. يتميز أسلوب ميكا فالتري بالبساطة ووضوح شخصياته. وتدور أحداث الرواية حول سنوحي الطبيب الملكي المصري في عهد الملك أخناتون الذي يروي قصته في منفاه بعد مقتل الملك. ثم نتتبع خطى الطبيب المصري عبر العواصم الرئيسية للعالم القديم.', 90.00, '2024-06-15 13:51:40', 'صورة واتساب بتاريخ 2024-06-15 في 01.31.38_1be0b1a9.jpg', '775.pdf', 'paid', 'accepted'),
(30, 'ماجدولين', 31, 6, 'الحُبُّ هو ذلك السلاح الذي يقضي أحيانًا على آمالنا، وربما على حياتنا. هذا هو محور الرواية التي تدور أحداثها حول وفاء «استيفن» لمحبوبته «ماجدولين» التي لم تترد كثيرًا في بيعه بالمال؛ فتزوجت من صديقه «إدوار» الذي كان يقاسمه في المأكل والمسكن. ويتبدل الحال وينتقم الدهر؛ فيفقد «إدوار» ثروته وينتحر، تاركًا زوجته فقيرة ومدينة، بينما يرث «استيفن» ثروة كبيرة. وتشعر «ماجدولين» بالذنب؛ فتذهب لحبيبها السابق معلنة ندمها وتوبتها، غير أن كرامته تسمو فوق حُبِّه؛ فيرفض توبتها، ولكنه يساعدها على تجاوز أزمتها المالية. ولم تُطق « ماجدولين» الحياة فتنتحر، ويدرك «استيفن» أن قلبه لا زال نابضًا بحبها فيودع الحياة غير آسف. وكانت آخر وصاياه أن يُدفن بجوار حبيبته؛ وكأنه يقول للقدر إن أبيت أن تجمعنا فى الحياة بأجسادنا فها نحن مجتمعون بأرواحنا.', 60.00, '2024-06-15 13:53:17', 'صورة واتساب بتاريخ 2024-06-15 في 02.01.12_2aeb6851.jpg', 'رواية ماجدولين-كتبنا.pdf', 'paid', 'accepted'),
(31, 'كونسيلر', 33, 6, 'في لياليها المحتقنة بذكريات الماضي البعيد، تقرر فاطمة الانتقام من كل الذين تسببوا لها في الأذى، ولكن هل يكفي الانتقام وحده ؟\r\nأيام طويلة وسنوات تمر في محاولات للتصالح مع النفس، التصالح مع الآخرين، التصالح مع قصص الحب المهملة، وربما التصالح مع الموت نفسه .. تنجح فاطمة مرات عديدة في تحقيق أحلامها وإشباع مشاعر الحب والتشفي معاً .. لكن القدر يخفي لها اختبار أخير يجبرها على البدء من جديد.ترى هل ينجح القلب العليل في الشفاء ؟ أم تدفعه الأيام نحو هزيمة أثقل ؟\r\nرواية فائقة الروعة، تغوص في حكاية ملهمة مستوحاة من قصة حقيقية، تترك بداخلك أثراً كبيرا عن الحياة وتصاريف القدر.', 70.00, '2024-06-15 14:03:33', 'صورة واتساب بتاريخ 2024-06-15 في 02.01.25_6d586bb6.jpg', 'رواية كونسيلر-كتبنا.pdf', 'paid', 'accepted'),
(32, 'رواية أبابيل', 34, 6, 'الحب هو التوأم اللطيف للموت كل شيء سيمضي انت فقط عليك ان تصمد لبعض الوقت ,ان تقاتل من اجل الوقوف مهما اهتزت الارض من تحت .', 70.00, '2024-06-15 14:07:51', 'صورة واتساب بتاريخ 2024-06-15 في 02.01.45_b29d933b.jpg', 'رواية أبابيل-كتبنا.pdf', 'paid', 'accepted'),
(33, 'رواية ما لا نبوح به', 35, 6, 'كم مرة إنفصلنا؟ لا أعرف، كل ما أعرفه أن البعد عنه يربكني، كنت أريد أن أعود، في كل مرة نبتعد كنتُ أعود دائماً، أرجع وأنا كُلي أمل أن يتغير، أن يصبح لي، أن يتخلى عن حماقاته ويراني على حقيقتي ولو لمرة واحدة، كنت أريده أن يكون مثالياً وأن يكون لي وحدي، كنتُ أريد كل شيء وحدي! ولم يكن هو يشعر بأي شيء .. تركني هنا في المنتصف تماماً، لا أنا أكملت الطريق وحدي، ولا أنا بقيت معه، صرتُ في هذا المنتصف اللعين، لا لون لي!تسافر بطلة الحكاية بحثاً عن نفسها، تقابل حبها الحقيقي في تلك المدينة الجميلة، تتعلق به، غير أن أحلامنا عن الحب ربما تبدو باهتة إذا جاءت في غير موعدها، لذلك تعود إلى الأسكندرية بحثاً عن حب قديم لطالما أرهقها، في المنتصف .. تكتشف أنها وحدها تحتاج إلى أن تحب نفسها قبل أن يحبها الآخرين، فهل تتغير تفاصيل الحكاية ؟!', 0.00, '2024-06-15 14:11:43', 'صورة واتساب بتاريخ 2024-06-15 في 02.01.58_9aee47c9.jpg', 'رواية ما لا نبوح به-كتبنا.pdf', 'free', 'accepted'),
(34, 'أدمنتك', 36, 6, 'قد لا نجد الأمان في أوطاننا، وقد لا نشعر بالسعادة مع أنفسنا،وقد لا نجد شيئا من صقيع زماننا ولكننا نجد الحلم والأمان والراحة في عيون من نحب', 45.00, '2024-06-15 14:15:11', 'صورة واتساب بتاريخ 2024-06-15 في 02.02.05_fad56af8.jpg', 'أدمنتك-كتبنا.pdf', 'paid', 'accepted'),
(35, 'رواية قواعد جارتين', 37, 6, 'ماذا لو وجدت نفسك بأرضٍ أقصى ما يمكنك بلوغه بها هو خمسون عامًا .. ليست هذه القاعدة الوحيدة فحسب، بل هناك ما هو أكثر من ذلك ..', 60.00, '2024-06-15 14:17:53', 'صورة واتساب بتاريخ 2024-06-15 في 02.03.40_a7a91046.jpg', 'رواية قواعد جارتين-كتبنا.pdf', 'paid', 'accepted'),
(36, 'عقدك النفسية سجنك الأبدي', 38, 2, 'إذا كنت غير مستعد لمواجهة واقعك , وإذا كنت تهرب من نفسك وتتجنب مواجهة ذاتك فهذا الكتاب ليس لك ! ستكتشف في هذا الكتاب العديد من الأموروالحقائق التي ستصدمك والتي اعتقدت أنها جزء من مسلمات الحياة ,, وسيتناول هذا الكتاب العديد من الأمور الجريئة والواقعية في مجتمعاتنا العربية التي لم يتم التطرق لها بشكل مفصل بالسابق وسيكون كفيل بإحداث نوبة وعي لديك ..\r\n\r\nاستعد لخوض رحلة فريدة من نوعها ستمكنك من رؤية الأمور بشكل مختلف ومعرفة ذاتك الحقيقية وعقدك النفسية وكيف تحظى بحياة كريمة وحقيقية..\r\nسيتناول الكتاب النقاط التالية :\r\n-كيف يتم تلقيننا الموروثات الفكرية؟ والى أي مدى يصل تأثير الأبوين في تشكيل هويتنا وردود أفعالنا؟\r\n-تحليل نفسي مفصل لأهم العقد النفسية التي تتواجد في جوانب العلاقات , العمل , المال , السلطة , الحب وغيرها\r\n-شرح مفصل لأساليب التحايل والتلاعب العاطفي بالعلاقات\r\n-كيف ننضج؟ ولماذا نخاف من المواجهة والتعبير عن افكارنا؟ وكيف نتجاوز مخاوفنا؟\r\n-ارتباط العقد النفسية بمفهوم الجنس.\r\nوالعديد من الأمور الأخرى ..', 50.00, '2024-06-15 14:24:27', 'صورة واتساب بتاريخ 2024-06-15 في 02.31.22_d0fc02b2.jpg', 'عقدك النفسية سجنك الأبدي_-كتبنا.pdf', 'paid', 'accepted'),
(37, 'جلسات نفسية', 39, 2, 'نتعلم في حياتنا كيفية التعامل مع كل شيء، مِن الدراسة للعمل والعلاقات ولكن لا نُحسن ‏التعامل مع أنفسنا. تتراكم مشكلات النفس دون أن نشعر ما المشكلة، وما الذي يؤلمنا، نُصدِر ‏أحكامًا قاسية على هذه النفس دون محاكمة عادلة، تتأثر كل جوانب حياتنا ولا ندري أن ‏المشكلة الحقيقية هي مشكلتنا في التعامل الخاطئ مع النفس!‏ لهذا أقدم لك هذا الكتاب كمرشد لك في الطريق‏ كل فصل من هذا الكتاب يُعينك على التعامل مع نفسك بشكل صحيح حتى تصل إلى ‏السكينة النفسية.‏ والتوفيق من الله أولًا وأخيرًا هو خالق النفس وهو يتولَّى صلاحها، فاللَّهم أصلِح نفوسنا وانفعنا ‏بما علمتنا.‏ ', 50.00, '2024-06-15 14:37:05', 'صورة واتساب بتاريخ 2024-06-15 في 02.31.36_071d481f.jpg', 'جلسات نفسية-كتبنا (1).pdf', 'paid', 'accepted'),
(38, 'أحببت وغدا', 40, 2, 'دومًا ننتظر شخصًا ما.. نظن أن بوجوده تتبدّد كافة أوجاعنا ويغمرنا السلام، ونتوهّم أننا حينها سنشعر بالاكتمال!\r\nوتصفعنا الحقيقة أن ذاك الشخص الذي رأينا فيه المنقذ.. ربما هو من يمنحنا خيبتنا الكبرى..\r\nوبدلًا من أن نُزهِر بجواره.. قد نذبل.. وننزوي.. ونتلاشى.. ونذوب!\r\nيصبح الآخر جحيمنا حين نسعى لتخدير أوجاعنا عبره، وتصبح العلاقة المرضية تلاهيًا عن مواجهة أنفسنا، مجرد هروب وفرار!إلى أولئك الذين يظنون أنهم يداوون الظمأ.. عبر تتبّع السراب!', 55.00, '2024-06-15 14:37:05', 'صورة واتساب بتاريخ 2024-06-15 في 02.31.46_a310f7c6.jpg', 'أحببت وغدا_68972_Foulabook.com_.pdf', 'paid', 'accepted'),
(39, 'ربما عليك أن تكلم أحدا', 41, 2, 'يتحدث الكتاب عن تجربة الكاتبة كمعالجة نفسية وتحليلية للمشاكل النفسية التي تعاني منها، وكيف يمكن للمعالجين النفسيين أن يساعدوا الآخرين على تحسين حالاتهم النفسية وعلاقاتهم الشخصية.\r\nتعرض لوري في الكتاب للعديد من الحالات التي تعاملت معها كمعالجة نفسية، بما في ذلك مشاكل العلاقات الشخصية والقلق والاكتئاب والإدمان والموت. ويسلط الضوء أيضًا على تجربة الكاتبة كمريضة نفسية، وكيف تمكنت من التغلب على مشاكلها الشخصية من خلال المعالجة النفسية والتحليلية.\r\nويتميز الكتاب بأسلوب سلس وممتع، ويوفر العديد من الأفكار والنصائح القيمة لأولئك الذين يعانون من مشاكل نفسية أو يرغبون في تحسين علاقاتهم الشخصية. ويمكن الاستفادة من هذا الكتاب أيضًا للمعالجين النفسيين وطلاب علم النفس.', 130.00, '2024-06-15 14:42:51', 'صورة واتساب بتاريخ 2024-06-15 في 02.31.56_153c9ad4.jpg', 'ربما عليك أن تكلم أحدا-كتبنا (1).pdf', 'paid', 'accepted'),
(40, 'فن اللامبالاة', 42, 2, 'كتاب فن اللامبالاة: لعيش حياة تخالف المألوف تأليف مارك مانسون .. ظل يُقال لنا طيلة عشرات السنوات إن التفكير الإيجابي هو المفتاح إلى حياة سعيدة ثرية. لكن مارك مانسون يشتم تلك \"الإيجابية\" ويقول: \" فلنكن صادقين، السيء سيء وعلينا أن نتعايش مع هذا \". لا يتهرّب مانسون من الحقائق ولا يغلفها بالسكّر، بل يقولها لنا كما هي: جرعة من الحقيقة الفجِّة الصادقة المنعشة هي ما ينقصنا اليوم.\r\nهذا الكتاب ترياق للذهنية التي نهدهد أنفسنا بها، ذهنية \" فلنعمل على أن يكون لدينا كلنا شعور طيب \" التي غزت المجتمع المعاصر فأفسدت جيلًا بأسره صار ينال ميداليات ذهبية لمجرد الحضور إلى المدرسة.\r\nينصحنا مانسون بأن نعرف حدود إمكاناتنا وأن نتقبلها. وأن ندرك مخاوفنا ونواقصنا وما لسنا واثقين منه، وأن نكفّ عن التهرب والفرار من ذلك كله ونبدأ مواجهة الحقائق الموجعة، حتى نصير قادرين على العثور على ما نبحث عنه من جرأة ومثابرة وصدق ومسؤولية وتسامح وحب للمعرفة.\r\nلا يستطيع كل شخص أن يكون متميزًا متفوقًا. ففي المجتمع ناجحين وفاشلين؛ وقسم من هذا الواقع ليس عادلًا وليس نتيجة غلطتك أنت. وصحيح أن المال شيء حسن، لكن اهتمامك بما تفعله بحياتك أحسن كثيرًا؛ فالتجربة هي الثروة الحقيقية.\r\nإنها لحظة حديث حقيقي صادق لشخص يمسكك من كتفيك وينظر في عينيك. هذا الكتاب صفعة منعشة لهذا الجيل حتى تساعده في عيش حياة راضية مستقرة.', 60.00, '2024-06-15 14:45:05', 'صورة واتساب بتاريخ 2024-06-15 في 02.32.08_dc06f470.jpg', 'فن اللامبالاة-كتبنا.pdf', 'paid', 'accepted'),
(41, 'لا بطعم الفلامنكو', 43, 2, 'يتناول فيه قصة حياة الشاب المصري عماد الذي يعمل كمهندس في بلجيكا، والذي يتورط في جريمة قتل غامضة.\r\n\r\nيتميز الكتاب بأسلوبه الجذاب والمشوق وتنوعه بين الرعب والبوليسي والدراما، كما يعرض الكتاب بعض المواضيع الاجتماعية والثقافية المهمة والمتعلقة بالهوية والتكامل بين الشرق والغرب.\r\n', 60.00, '2024-06-15 14:46:09', 'صورة واتساب بتاريخ 2024-06-15 في 02.32.16_bbdb03a9.jpg', 'لأ بطعم الفلامنكو-كتبنا.pdf', 'paid', 'accepted'),
(42, 'قواعد السطوة', 44, 2, 'يعد هذا الكتاب من الكتب الشهيرة في مجال تطوير الذات والقيادة والإدارة، حيث يتحدث عن السلطة والنفوذ وكيفية الحصول عليهما والحفاظ عليهما. يقدم الكتاب 48 قاعدة تساعد على تحقيق النجاح والسطوة في الحياة الشخصية والعملية، ويستند المؤلف في هذه القواعد على الأمثلة التاريخية والقصص الحقيقية للشخصيات الشهيرة في مختلف المجالات.\r\nتهدف فلسفة الكتاب إلى تعليم القراء كيفية الحصول على النفوذ والسلطة، وكيفية استخدامهما بطريقة مؤثرة وفعالة في الحياة اليومية. ويتضمن الكتاب مجموعة من المفاهيم الأساسية مثل تحليل القوى، وتحقيق النفوذ، والتحكم في العواطف، والاستفادة من الضعفاء، وغيرها الكثير.', 250.00, '2024-06-15 14:48:57', 'صورة واتساب بتاريخ 2024-06-15 في 02.32.24_3201fa45.jpg', 'قواعد السطوة-كتبنا.pdf', 'paid', 'accepted'),
(43, 'تاريخ الفنون وأشهر الصور', 45, 1, 'أراد سلامة موسى من خلال إخراج هذا الكتاب أن يقدم للقراء مجموعة من الصور والرسومات الفنية الأوروبية المشهورة، وأن يضيف إلى ذلك لمحة من تاريخ هذه الرسومات وتاريخ رساميها، بما يشتمل عليه هذا التاريخ من سياقات وظروف أدت إلى بعث هذه الفنون إلى حيز الوجود الإنساني. وقد قدم موسى أيضًا شرحًا للنظرية العامة في الفنون الجميلة، كما بين أوجه الانحطاط التي تعتريها برأيه. ويعد هذا العمل ملخصًا لكتاب السير وليم أوربين الذي جاء بعنوان «خلاصة الفن».', 80.00, '2024-06-15 15:09:23', 'صورة واتساب بتاريخ 2024-06-15 في 16.06.29_0f679f6e.jpg', 'تاريخ الفنون وأشهر الصور_99996_Foulabook.com_.pdf', 'paid', 'accepted'),
(44, 'الموسيقى', 46, 1, 'الموسيقى تقود اظعان المسافرين وتخفف تاثير التعب وتقصر مديد الطرقات الموسيقى رفيقة الراعي في وحدته وهم ان جلس على الصخرة في وسط قطيعة نفخ بشبابته الحانا تعرفها نعاجه فترعى الأعشاب آمنةيأتي المولود من عالم الغيب الى دنيانا فتقابله القابلة والأقارب بأغاني الفرح متأهلين بأنا شيد الابتهاج والحبور', 90.00, '2024-06-15 15:10:36', 'صورة واتساب بتاريخ 2024-06-15 في 16.06.44_f28f5268.jpg', '45413.Foulabook.com.2018-02-25.1519564759.pdf', 'paid', 'accepted'),
(45, 'الفن والحياة', 47, 1, 'رصد ثروت عكاشة أن الاتصال الزمني الخفي بين الأعمال الفنية المتباينة التي تلتقي جميعها في لحن إنساني منسجم ، ومتكامل ، و قابل لإعادة التشكل كلما جددت الحضارة من أدواتها التكنولوجية ، و أفكارها الثقافية.\r\nويمكننا ملاحظة أربع استراتيجيات نقدية جزئية ، و كشفية تعبر عن نظرة د. عكاشة للآثار الفنية العالمية ؛ و هي :\r\nأولا : الجذور الروحية ، و الإنسانية العميقة للفن.\r\nثانيا : الفن بين السياق الثقافي ، و البناء الجمالي الداخلي للأثر.\r\nثالثا : البعث المستمر ، أو التجدد الدائري للأعمال الفنية.\r\nرابعا : التجلي الإبداعي للمكان.\r\nيحاول د. عكاشة أن يقبض على اللحظات الأولى لنشوء الفن في ذلك العالم المعنوي ، أو الروحي / الأصلي ، و هو يتجسد في مادة صوتية ، أو تشكيلية ، أو نصية لها حضور نسبي ممتد في المتلقي ، و سياقه الثقافي الآني الذي يضيف إلى تلك الأصالة ، و لا يناقضها ؛ فالفن يجدد جذوره الروحية في الوعي ، و اللاوعي ، و يضيف الناقد إليها دلالات تأويلية جديدة تقوم على إعادة تشكيل الطاقة الروحية المنتجة ، و العابرة للزمان ، و المكان.\r\nإن الفن يلتحم بالنماذج المعنوية القوية للحق ، و الخير ، و الجمال ، و العدالة ، و الحدس ، أو نور المعرفة المباشرة ؛ و من ثم يربط د. عكاشة بين الإجادة الفنية ، و الأخلاق ، و يدلل على ذلك ببناء الإغريق لأخلاقياتهم على أسس جمالية ، و منح الفنون مكانة سامية ، و امتداد ربط الفن بالأخلاق إلى الفنانين في العصر الحديث.\r\nو أتفق مع تلك الرؤية التي تربط الإتقان الجمالي للعمل بالأصالة الأخلاقية ؛ إذ ينبع كل منهما من مصدر روحي قديم ، و متجدد في النفوس المتعالية في الأزمنة المختلفة ، و ربما يكون ذلك النموذج الذي يجمع بين الوعي الإبداعي ، و قيم الجمال ، و العدالة هو سر التكرار الفريد للفن في تاريخ الإنسانية.\r\nو يلتقي الفن عند د. عكاشة بحدس دائري يعكس الفكر ، و الانفعالات بصورة عابرة للسياق الزمني بين المبدع ، و المتلقي ؛ و يدلل على ذلك باتحاد المتلقي اليوم بنشيد الفرحة في نهاية السيمفونية التاسعة لبيتهوفن ، و كذلك ينفعل بمعاني التراجيديات اليونانية القديمة.', 80.00, '2024-06-15 15:11:54', 'صورة واتساب بتاريخ 2024-06-15 في 16.06.59_abc3f09c.jpg', 'الفن والحياة_36194_Foulabook.com_.pdf', 'paid', 'accepted'),
(46, 'تاريخ الجمال', 48, 1, 'لقد تغيّرت قوانين الجمال بحسب الحقب، ويُبرز هذا الكتاب تحوّلاتها. كما يصف تاريخ الجمال هذا ما يُعجب أو ما لا يُعجب في الجسد، ضمن ثقافة وزمن محدّدين: أي الطلّة والقسمات المجمّلة، والأعطاف اللافتة أو المنتقصة، ووسائل التجميل المعاد تقويمها. ولا شك أن المتخيّل يأخذ في هذا التاريخ دوراً يتماشى مع القيم السائدة في كل فترة من الفترات. لم يكفّ الجمال عن غبراز شخصية الأفراد، وفي الوقت ذاته كان يُظهر التباينات القائمة بين الفئات الاجتماعية والأنماط والأجيال. ولأن الجمال موضوع مثير للقلق أو التفاخر أمام المرآة، فهو أيضاً مرآة المجتمعات.', 80.00, '2024-06-15 15:13:11', 'صورة واتساب بتاريخ 2024-06-15 في 16.07.10_76af529d.jpg', 'تاريخ الجمال_ الجسد وفن التزيين من عصر النهضة الأوروبية إلى أيامنا_28508_Foulabook.com_.pdf', 'paid', 'accepted'),
(47, 'تحليل المفهوم وتاريخه', 49, 1, 'لا يقدم هذا الكتاب تاريخاً خاصاً بالنظريات السيميائية التي عرفتها الأزمنة المعاصرة، ولا يحدثنا عن المردودية التحليلية للمنهج السيميائي، ولا يحدثنا عن الأسماء الكبيرة التي صنعت مجد السيميائيات الحديثة وشهرتها، إنه يكتفي بتأمل تجربة إنسانية شاملة: محاولات الإنسان المضنية من أجل التخلص من برائن طبيعة هوجاء لكي يحتمي بعالم ثقافي يمنحه الدفء والطمأنينة ويوفر له التفاسير الممكنة للظواهر الطبيعية والاجتماعية على حد سواء، إنه مقاربة سيميائية تحترم استقلال مفهوم \"العلامة\" المعرفي كحقل دراسي، وفي الوقت نفسه عرض لأصوله اللسانية واللغوية، وااستكشاف لأشكال التصنيف السيميائي، ولأنماط الإنتاج السيميائي، وللقضايا الفلسفية التي يختزنها مفهوم العلامة. إنه تأريخ لرحلة الإنسان مع الرموز وأشكالها المتعددة، وللرؤى الدينية والفلسفية والاجتماعية التي رأت في عناصر الوجود رموزاً تنوب عن قوى أخرى غير مرئية، أو \"الصوت الذي يحدثنا الله عبره عن قدرته\" كما هو شائع في كل الديانات.', 100.00, '2024-06-15 15:14:21', 'صورة واتساب بتاريخ 2024-06-15 في 16.07.19_a881d169.jpg', 'العلامة؛ تحليل المفهوم وتاريخه_Foulabook.com_.pdf', 'paid', 'accepted'),
(48, 'استجوابات', 50, 1, 'ستة استجوابات صحفية توافر على جمعها وتقديمها معد لم يشأ الإشارة إلى اسمه ، ولا غرابة فمحبو أبي سهيل - رحمه الله - كُثُر، وتضمن الكتاب الذي ضم اللقاءات إهداءً إلى الذين سألوا، ومقابلات لمجلة العربي الكويتية وصحيفة الشرق الأوسط ومجلة الشرق الأوسط والمجلة العربية ومجلة اليمامة وجريدة المسلمون حول الشعر والفكر والمجتمع والإبداع والالتزام والحرب السياسية والأعماق ومداعبات ومشاغبات، وهي حوارات أجريت مع الدكتور غازي القصيبي خلال عامي 1990 و1991م، وتناولت بعض القضايا الذاتية الإبداعية والهموم القومية. صدرت الاستجوابات في كتاب من القطع المتوسط ومئة وسبعين صفحة عن العبيكان للنشر.', 120.00, '2024-06-15 15:15:38', 'صورة واتساب بتاريخ 2024-06-15 في 16.07.29_06ab39a8.jpg', 'استجوابات8973.Foulabook.com.1520770929.pdf', 'paid', 'accepted'),
(49, 'PHP Guide\n', 51, 5, ' open-source scripting language, PHP: A Beginner\'s Guide teaches you how to write basic PHP programs and enhance them with more advanced features such as MySQL and SQLite database integration, XML input, and third-party extensions. This fast-paced tutorial provides one-stop coverage of software installation, language syntax and data structures, flow control routines, built-in functions, and best practices.', 200.00, '2024-06-15 15:33:01', 'download.jpeg', 'PHP - A Beginner’s Guide [EnglishOnlineClub.com].pdf', 'paid', 'accepted'),
(50, 'Laravel', 52, 5, ' development framework and its ecosystem of tools let you quickly build new sites and applications with clean, readable code. Fully updated to include Laravel 10, the third edition of this practical guide provides the definitive introduction to one of today\'s most popular web frameworks.\r\n\r\nMatt Stauffer, a leading teacher and developer in the Laravel community, delivers a high-level overview and concrete examples to help experienced PHP web developers get started with this framework right away. This updated edition covers the entirely new auth and frontend tooling and other first-party tools introduced since the second edition.', 250.00, '2024-06-15 15:44:07', 'download (1).jpeg', 'OReilly.Laravel.Up.and.Running.2nd.Edition.www.EBooksWorld.ir.pdf', 'paid', 'accepted'),
(51, 'Web Design', 53, 5, 'Do you want to build web pages, but have no previous experience? This friendly guide is the perfect place to start. You’ll begin at square one, learning how the Web and web pages work, and then steadily build from there. By the end of the book, you’ll have the skills to create a simple site with multi-column pages that adapt for mobile devices.\r\n\r\nLearn how to use the latest techniques, best practices, and current web standards―including HTML5 and CSS3. Each chapter provides exercises to help you to learn various techniques, and short quizzes to make sure you understand key concepts.', 300.00, '2024-06-15 15:53:37', '91YPcsFTbIL._SY385_.jpg', 'Learning-Web-Design-5th-Edition-by-Jennifer-Niederst-booksfree.org_.pdf', 'paid', 'accepted'),
(52, 'JavaScript\n ', 54, 5, 'This book makes JavaScript less challenging to learn for newcomers, by offering a modern view that is as consistent as possible.\r\n\r\n', 230.00, '2024-06-15 15:58:29', '51TxsqnWXpL._SL1360_.jpg', 'impatient-js-preview-book.pdf', 'paid', 'accepted'),
(53, 'PHP and MySQL', 55, 5, 'Beginning PHP and MySQL: From Novice to Professional, Fourth Edition is a major update of W. Jason Gilmore\'s authoritative book on PHP and MySQL. The fourth edition includes complete coverage of PHP 5.3 features, including namespacing, an update of AMP stack installation and configuration, updates to Zend Framework, coverage of MySQL Workbench, and much more.\r\n\r\nYou\'ll not only receive extensive introductions to the core features of PHP, MySQL, and related tools, but you\'ll also learn how to effectively integrate them in order to build robust data-driven applications. Gilmore has seven years of experience working with these technologies, and he has packed this book with practical examples and insight into the real-world challenges faced by developers. Accordingly, you will repeatedly return to this book as both a valuable instructional tool and reference guide.', 400.00, '2024-06-15 16:03:08', '61TcgPP8I6L._SY425_.jpg', '978-1-4302-6044-8.pdf', 'paid', 'accepted'),
(72, 'js', 47, 5, 'This is private category', 100.00, '2024-06-22 15:20:18', '../images/books_images/Untitled Diagram-erd.drawio.png', '../files/BIS Graduation Project template 2024.pdf · إصدار ‏١‏.pdf', 'paid', 'rejected'),
(73, 'js', 47, 5, 'This is private category', 100.00, '2024-06-22 15:20:35', '../images/books_images/Untitled Diagram-erd.drawio.png', '../files/BIS Graduation Project template 2024.pdf · إصدار ‏١‏.pdf', 'paid', 'rejected'),
(74, 'js', 47, 5, 'This is private category', 100.00, '2024-06-22 15:20:50', '../images/books_images/Untitled Diagram-erd.drawio.png', '../files/BIS Graduation Project template 2024.pdf · إصدار ‏١‏.pdf', 'paid', 'rejected'),
(75, 'Let\'s upload from here', 47, 5, 'This is private category', 100.00, '2024-06-22 15:27:55', '../images/books_images/Untitled Diagram-erd.drawio.png', '../files/978-1-4302-6044-8.pdf', 'paid', 'rejected'),
(76, 'js', 22, 5, 'This is private category', 100.00, '2024-06-22 18:45:36', '../images/books_images/Untitled Diagram-erd.drawio.png', '../files/BIS Graduation Project template 2024.pdf · إصدار ‏١‏.pdf', 'paid', 'rejected'),
(77, 'html', 22, 5, 'This is private category', 100.00, '2024-06-22 18:46:05', '../images/books_images/Untitled Diagram-erd.drawio.png', '../files/BIS Graduation Project template 2024.pdf · إصدار ‏١‏.pdf', 'paid', 'rejected'),
(78, 'css', 22, 5, 'This is private category', 100.00, '2024-06-22 18:46:21', '../images/books_images/Untitled Diagram-erd.drawio.png', '../files/BIS Graduation Project template 2024.pdf · إصدار ‏١‏.pdf', 'paid', 'rejected'),
(79, 'js', 22, 5, 'This is private category', 100.00, '2024-06-23 09:55:09', '../images/books_images/Untitled Diagram-erd.drawio.png', '../files/BIS Graduation Project template 2024.pdf · إصدار ‏١‏.pdf', 'paid', 'rejected'),
(81, 'js', 64, 5, 'This is private category', 100.00, '2024-06-23 22:14:02', '../images/books_images/2.png', '../files/Documentation (1).pdf', 'paid', 'rejected'),
(83, 'js', 22, 5, 'This is private category', 100.00, '2024-06-23 23:12:03', '../images/books_images/2.png', '../files/BIS Graduation Project template 2024.pdf · إصدار ‏١‏.pdf', 'paid', 'rejected'),
(84, 'js', 22, 5, 'This is private category', 100.00, '2024-06-23 23:19:39', '../images/books_images/2.png', '../files/BIS Graduation Project template 2024.pdf · إصدار ‏١‏.pdf', 'paid', 'rejected'),
(85, 'js', 22, 5, 'This is private category', 100.00, '2024-06-23 23:22:32', '../images/books_images/2_1.png', '../files/BIS Graduation Project template 2024.pdf · إصدار ‏١‏.pdf', 'paid', 'rejected'),
(87, 'js', 22, 5, 'This is private category', 100.00, '2024-06-23 23:27:20', '../images/books_images/book_cover_6678af5888c062.66238235.png', '../files/ER Model.pdf', 'paid', 'rejected'),
(88, 'js', 22, 5, 'This is private category', 100.00, '2024-06-23 23:30:15', '../images/books_images/ER Model.drawio.png', '../files/ER Model.pdf', 'paid', 'rejected'),
(89, 'ja', 22, 5, 'This is private category', 100.00, '2024-06-23 23:36:34', 'images/books_images/ER Model.drawio.png', 'files/ER Model.pdf', 'paid', 'rejected'),
(90, 'لبلب', 22, 5, 'A good ps3 game', 100.00, '2024-06-23 23:38:19', 'ER Model.drawio.png', 'ER Model.pdf', 'paid', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'artistic'),
(2, 'science'),
(3, 'horror'),
(4, 'history'),
(5, 'coding'),
(6, 'romance');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `message_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`message_id`, `message`, `user_id`) VALUES
(55, ' Fill up the form and our team will get back to you within 24 hours\\r\\n\\r\\n', 16);

-- --------------------------------------------------------

--
-- Table structure for table `discount_requests`
--

CREATE TABLE `discount_requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount_requests`
--

INSERT INTO `discount_requests` (`request_id`, `user_id`, `book_id`, `reason`, `status`) VALUES
(106, 16, 25, ' Are you looking for a great deal on our books? You\\\'re in the right place! We are offering special discounts on a selection of our best-selling titles as a form of financial aid for those who may not have enough money to buy our books. Just fill out the form to request your discount and enjoy savings on your next read. Don’t miss out on this limited-time offer!\\r\\n\\r\\n', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `book_id`, `comment`) VALUES
(85, 3, 37, 'thanks');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`order_detail_id`, `order_id`, `book_id`, `quantity`) VALUES
(166, 99, 29, 1),
(167, 99, 50, 1),
(168, 99, 37, 1),
(169, 99, 28, 1),
(170, 99, 52, 1),
(171, 99, 44, 1),
(173, 101, 38, 1),
(174, 101, 45, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `status`, `username`, `email`, `price`, `token`) VALUES
(86, 3, '2024-06-18 10:56:33', 'completed', 'EyadWalid', 'eiadwaleed16@gmail.com', '440', 'tok_1PT0eGHp65tXrQ3PrTgE3Km9'),
(88, 3, '2024-06-21 04:37:57', 'completed', '', '', '700', 'tok_1PU0AWHp65tXrQ3Pz1nD9lAQ'),
(89, 3, '2024-06-21 04:50:24', 'completed', 'EyadWalid', 'eyadwalid004@gmail.com', '300', 'tok_1PU0MYHp65tXrQ3PiDoGIaZ4'),
(90, 3, '2024-06-21 04:54:53', 'completed', 'EyadWalid', 'eyadwalid004@gmail.com', '0', 'tok_1PU0OiHp65tXrQ3PORYOycOA'),
(91, 3, '2024-06-21 04:55:38', 'completed', 'EyadWalid', 'eyad@gmail.com', '130', 'tok_1PU0RcHp65tXrQ3PbwrNnMLk'),
(92, 3, '2024-06-21 10:31:53', 'completed', 'EyadWalid', 'adam@gmail.com', '1050', 'tok_1PU5h1Hp65tXrQ3PblLBGISV'),
(93, 3, '2024-06-22 06:30:10', 'completed', 'EyadWalid', 'eyadwalid004@gmail.com', '400', 'tok_1PUOOeHp65tXrQ3PhzlnnRzU'),
(94, 3, '2024-06-22 06:41:24', 'completed', 'EyadWalid', 'adam@gmail.com', '230', 'tok_1PUOZYHp65tXrQ3P0x3pEHy5'),
(95, 3, '2024-06-22 07:00:11', 'completed', 'EyadWalid', 'adam@gmail.com', '50', 'tok_1PUOriP3auuwP0CrnmjRD9FM'),
(96, 3, '2024-06-22 07:34:46', 'completed', 'EyadWalid', 'eyad@gmail.com', '350', 'tok_1PUPPCP3auuwP0CrClisArAM'),
(97, 3, '2024-06-22 07:37:32', 'completed', 'EyadWalid', 'adam@gmail.com', '350', 'tok_1PUPRsP3auuwP0Cr1GlkaJOt'),
(98, 3, '2024-06-22 10:57:42', 'completed', 'EyadWalid', 'basma@gmail.com', '200', 'tok_1PUSZaP3auuwP0CrfaW6J9Jc'),
(99, 3, '2024-06-23 20:52:37', 'completed', 'EyadWalid', 'eyad@gmail.com', '770', 'tok_1PUyKrP3auuwP0CrPCiRTHOf'),
(101, 16, '2024-06-23 21:33:53', 'completed', 'eyad', 'eyad@gmail.com', '135', 'tok_1PUyymP3auuwP0CrUnZ304qT');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_books`
--

CREATE TABLE `purchased_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchased_books`
--

INSERT INTO `purchased_books` (`id`, `user_id`, `book_id`, `purchase_date`) VALUES
(37, 3, 29, '2024-06-23 21:52:37'),
(38, 3, 50, '2024-06-23 21:52:37'),
(39, 3, 37, '2024-06-23 21:52:37'),
(40, 3, 28, '2024-06-23 21:52:37'),
(41, 3, 52, '2024-06-23 21:52:37'),
(42, 3, 44, '2024-06-23 21:52:37'),
(44, 16, 38, '2024-06-23 22:33:53'),
(45, 16, 45, '2024-06-23 22:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `save`
--

CREATE TABLE `save` (
  `save_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `save`
--

INSERT INTO `save` (`save_id`, `user_id`, `book_id`, `date_added`) VALUES
(15, 16, 19, '2024-06-23 22:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `type` enum('admin','author','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `phone`, `address`, `image`, `birth_date`, `type`) VALUES
(1, 'adam', 'adam@gmail.com', '$2y$10$bj/38/v885OX/k5gUgwb4OJ/oYCME2Q1NIQzFkpapGy.naDmGyesO', '123456789', '', '', '2024-05-03', 'admin'),
(2, 'eyad', 'eyad@gmail.com', '$2y$10$PngvJrG8aPC5AMSSN9ZPP.dzrD2jYa4KIGKZhFh5lNtlIWaiGOh2e', '123456789', '', 'photo-1511367461989-f85a21fda167.avif', '2024-05-10', 'admin'),
(3, 'basma', 'basma@gmail.com', '$2y$10$o4A45FpS92d3ChFkEeKEvec7aoPK55XHag.s.7ZPG.c0KJRZqEbr2', '123456789', '', '2.png', '2024-05-21', 'user'),
(4, 'basant', 'basant@gmail.com', '$2y$10$d/x2sbi9nKwiMWo7.c2nWOEN2XRJVXVZwWyIxLbOh8IaNQMPnSk1m', '123456789', '', '', '2024-05-27', 'user'),
(7, 'alaa', 'alaa@gmail.com', '$2y$10$Yz3mAR/ovXUL8bCt1LK6b.15wAiQkxRqvg4IVn3OPk9Bk8Nul9zhO', '01276866491', '', '', '2002-06-01', 'user'),
(9, 'eyad', 'eiadwaleed16@gmail.com', '$2y$10$tva5LdtfbVFScWcPFMUvYOUHSoUbZ2XzfTZH/hmFJgfcilqW.8waK', '01052525252', '', '', '2024-06-12', 'user'),
(15, 'eiad', 'eiad@gmail.com', '$2y$10$tXbeADm2a5yYC9MJkaMVN.EQTJnOR14f/0hfvZvOKLFANI7roiQwe', '01015001975', '', '', '2017-06-15', 'user'),
(16, 'eyadw', 'eyadw@gmail.com', '$2y$10$09n0mwG4PeYvDY8sCvtH2u7FkFP677vxmS63lhVN5oayG3daR4DcW', '01015001000', '', '2.png', '2014-10-16', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`, `book_id`, `date_added`) VALUES
(41, 3, 37, '2024-06-23 08:04:22'),
(43, 16, 19, '2024-06-23 22:32:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `discount_requests`
--
ALTER TABLE `discount_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `purchased_books`
--
ALTER TABLE `purchased_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `save`
--
ALTER TABLE `save`
  ADD PRIMARY KEY (`save_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `discount_requests`
--
ALTER TABLE `discount_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `purchased_books`
--
ALTER TABLE `purchased_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `save`
--
ALTER TABLE `save`
  MODIFY `save_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD CONSTRAINT `contact_us_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `discount_requests`
--
ALTER TABLE `discount_requests`
  ADD CONSTRAINT `discount_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `discount_requests_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `purchased_books`
--
ALTER TABLE `purchased_books`
  ADD CONSTRAINT `purchased_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `purchased_books_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `save`
--
ALTER TABLE `save`
  ADD CONSTRAINT `save_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `save_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
