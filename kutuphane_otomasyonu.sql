-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Ara 2024, 18:52:04
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kutuphane_otomasyonu`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitaplar`
--

CREATE TABLE `kitaplar` (
  `ID` int(11) NOT NULL,
  `kitap_ismi` varchar(200) NOT NULL,
  `kitap_türü` varchar(200) NOT NULL,
  `kitap_sayfa_sayisi` int(11) NOT NULL,
  `kitap_yazari` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kitaplar`
--

INSERT INTO `kitaplar` (`ID`, `kitap_ismi`, `kitap_türü`, `kitap_sayfa_sayisi`, `kitap_yazari`) VALUES
(1, 'Lale Devri', 'Mektup', 125125, 'Ben'),
(2, 'Cenge Giderken', 'Hikaye', 456, 'Kaan Kaya'),
(3, 'Ateşten Gömlek', 'Roman', 235, 'Halide Edip Adıvar'),
(5, 'The Walking Dead', 'Roman', 965, 'Hatırlamıyorum'),
(6, 'Bu Bir Test Kitabıdır', 'Hikaye', 241, 'Ben'),
(7, 'Sherlock Holmes', 'Roman', 1025, 'Valla Kitap Uzakta Okuyamadım'),
(8, 'Bu tür test kitabıdır', 'Edebiyat', 125, 'Ben'),
(12, 'Bu Message Box Testtidir', 'Anlatı', 145, 'A'),
(13, 'Bu Message Box Testtidir 2', 'Anlatı', 145, 'B');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitap_turleri`
--

CREATE TABLE `kitap_turleri` (
  `ID` int(11) NOT NULL,
  `Turler` varchar(199) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kitap_turleri`
--

INSERT INTO `kitap_turleri` (`ID`, `Turler`) VALUES
(1, 'Roman'),
(2, 'Anı'),
(3, 'Anlatı'),
(4, 'Araştırma-İnceleme'),
(5, 'Bilim'),
(6, 'Biyografi'),
(7, 'Çizgi Roman'),
(8, 'Deneme'),
(9, 'Edebiyat'),
(10, 'Eğitim'),
(11, 'Felsefe'),
(12, 'Gençlik'),
(13, 'Gezi'),
(14, 'Hikaye'),
(15, 'Hobi'),
(16, 'İş Ekonomi'),
(17, 'Kişisel Gelişim'),
(18, 'Konuşmalar'),
(19, 'Masal'),
(20, 'Mektup'),
(23, 'Masal'),
(24, 'Mektup'),
(25, 'Mizah'),
(26, 'Öykü'),
(27, 'Polisiye'),
(28, 'Psikoloji'),
(29, 'Resimli Öykü'),
(30, 'Sağlık'),
(31, 'Sanat'),
(32, 'Tasarım'),
(33, 'Müzik'),
(34, 'Sinema Tarihi'),
(35, 'Söyleşi'),
(36, 'Şiir'),
(37, 'Tarih'),
(38, 'Yemek Kitapları'),
(39, 'Çocuk Kitapları'),
(40, 'Korku-Gerilim'),
(41, 'Aşk'),
(42, 'Din (İslam)'),
(43, 'Fantastik'),
(44, 'Macera-Aksiyon'),
(45, 'Bilim Kurgu'),
(46, 'Türk Klasikleri'),
(47, 'Manga'),
(48, 'Yeraltı Edebiyatı'),
(49, 'Eğitim'),
(50, 'Mezhepler-Tarikatlar'),
(51, 'Spor'),
(52, 'Dergi'),
(53, 'Bilgisayar-İnternet'),
(54, 'Kadın-Erkek'),
(55, 'Aile'),
(56, 'Efsaneler-Destanlar'),
(57, 'Antaloji'),
(58, 'Uzay'),
(59, 'Coğrafya');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `ID` int(11) NOT NULL,
  `kullanici_adi` varchar(100) NOT NULL,
  `kullanici_sifre` varchar(100) NOT NULL,
  `kullanici_dogum_tarihi` date NOT NULL,
  `kullanici_mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`ID`, `kullanici_adi`, `kullanici_sifre`, `kullanici_dogum_tarihi`, `kullanici_mail`) VALUES
(1, 'Kaan', '14533541', '2024-11-06', 'kaan@gmail.com'),
(4, 'Mondial Drift l', '1717', '2024-11-01', '125@gmail.com'),
(5, 'Metin Kaya', '159951', '2024-12-04', 'Metin@gmail.com'),
(6, 'Bu Message Deneme', '1t2t', '2024-12-11', '1tD@gmail.com'),
(7, 'test', '123', '2024-12-05', '123@gmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `verilen_kitaplar`
--

CREATE TABLE `verilen_kitaplar` (
  `ID` int(11) NOT NULL,
  `alici` varchar(100) NOT NULL,
  `kitap_ismi` varchar(100) NOT NULL,
  `verilen_tarih` varchar(100) NOT NULL,
  `alici_sinif` varchar(255) DEFAULT NULL,
  `alici_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `verilen_kitaplar`
--

INSERT INTO `verilen_kitaplar` (`ID`, `alici`, `kitap_ismi`, `verilen_tarih`, `alici_sinif`, `alici_no`) VALUES
(1, 'Ali Kaya', 'The Lord Of The Rings', '26/11/2024', '', '0'),
(3, 'Kaan Kaya', 'The Walking Dead', '26-10-2006', '', '0'),
(4, 'Kaan Kaya', 'Deneme Kitabı', '30-11-2023', '11/B Bilişim', '224'),
(5, 'Dilek Kaya', 'Motor Aldım', '29-11-2024', '12/A', '325'),
(8, 'Muazzez Kaya', 'DenemeLER', '2024-12-13', '145/B', '145');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kitaplar`
--
ALTER TABLE `kitaplar`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `kitap_turleri`
--
ALTER TABLE `kitap_turleri`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `verilen_kitaplar`
--
ALTER TABLE `verilen_kitaplar`
  ADD PRIMARY KEY (`ID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kitaplar`
--
ALTER TABLE `kitaplar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `kitap_turleri`
--
ALTER TABLE `kitap_turleri`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `verilen_kitaplar`
--
ALTER TABLE `verilen_kitaplar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
