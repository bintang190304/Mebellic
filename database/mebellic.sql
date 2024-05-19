-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2023 pada 06.12
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mebellic`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkout`
--

CREATE TABLE `checkout` (
  `order_id` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `nama_pemesan` varchar(250) NOT NULL,
  `notelp_pemesan` varchar(21) NOT NULL,
  `email_pemesan` varchar(250) NOT NULL,
  `alamat_pemesan` varchar(250) NOT NULL,
  `purchise_type` varchar(250) NOT NULL,
  `payment_status` varchar(250) NOT NULL,
  `totals` varchar(100) NOT NULL,
  `creation_date` date NOT NULL,
  `creation_time` time NOT NULL,
  `order_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `checkout`
--

INSERT INTO `checkout` (`order_id`, `id_session`, `nama_pemesan`, `notelp_pemesan`, `email_pemesan`, `alamat_pemesan`, `purchise_type`, `payment_status`, `totals`, `creation_date`, `creation_time`, `order_status`) VALUES
(1, 1, 'Bintang', '85775723618', 'bintang@gmail.com', 'Sukaraya Regensi Blok F-18', 'bank', 'packed', '6064800', '2023-05-11', '07:45:40', 'PENDING'),
(2, 1, 'Lintang', '85775723618', 'lintang@gmail.com', 'Cikarang Asri Blok A-1', 'cod', 'packed', '6064800', '2023-05-11', '07:51:33', 'PENDING'),
(3, 1, 'Bintang', '85775723618', 'bintang@gmail.com', 'Pondok Kelapa No. 22', 'bank', 'packed', '6711200', '2023-05-11', '08:19:17', 'PENDING'),
(4, 2, 'Faris', '85775723618', 'farisnvl@gmail.com', 'Duren Sawit No. 1', 'cod', 'packed', '1399000', '2023-05-11', '09:00:54', 'PENDING'),
(5, 2, 'Syarif', '85775723618', 'syarif@gmail.com', 'Pondok Kopi No. 3', 'bank', 'packed', '8097200', '2023-05-11', '09:23:45', 'PENDING'),
(6, 3, 'Wira', '8638221', 'wira@gmail.com', 'Cikarang Asri', 'cod', 'packed', '327900', '2023-05-11', '11:15:51', 'PENDING');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Chairs'),
(2, 'Beds'),
(3, 'Lemari'),
(4, 'Accesoris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_cart` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `last_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_cart`, `id_produk`, `jumlah`, `id_session`, `last_price`) VALUES
(1, 22, 1, 1, 32900),
(2, 21, 1, 1, 5999000),
(3, 13, 1, 1, 679300),
(4, 18, 1, 2, 1399000),
(5, 10, 1, 2, 3499000),
(6, 20, 1, 2, 3199200),
(7, 22, 1, 3, 32900),
(8, 9, 1, 3, 295000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_address` int(11) NOT NULL,
  `owner_name` varchar(250) NOT NULL,
  `purchise_type` varchar(250) NOT NULL,
  `payment_status` varchar(250) NOT NULL,
  `totals` varchar(100) NOT NULL,
  `creation_date` date NOT NULL,
  `creation_time` time NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `order_valid_date` date NOT NULL,
  `order_valid_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail`
--

CREATE TABLE `order_detail` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `item_code` varchar(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `disc` int(3) NOT NULL,
  `price` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `order_detail`
--

INSERT INTO `order_detail` (`detail_id`, `order_id`, `img`, `item_code`, `item_name`, `qty`, `disc`, `price`) VALUES
(1, 1, '23.jpg', '22', 'Maru Floor Cushion - Linori', 2, 0, '65800'),
(2, 1, '22.jpg', '22', 'Liberty Sofa Tidur Fabric - Informa', 1, 0, '5999000'),
(3, 2, '23.jpg', '22', 'Maru Floor Cushion - Linori', 2, 0, '65800'),
(4, 2, '22.jpg', '22', 'Liberty Sofa Tidur Fabric - Informa', 1, 0, '5999000'),
(5, 3, '23.jpg', '22', 'Maru Floor Cushion - Linori', 1, 0, '32900'),
(6, 3, '22.jpg', '22', 'Liberty Sofa Tidur Fabric - Informa', 1, 0, '5999000'),
(7, 3, '14.jpg', '22', 'Cermin Kotak White Story - Livien', 1, 0, '679300'),
(8, 4, '19.jpg', '18', 'STAN Counter Stool Hitam - Heim Studio', 1, 0, '1399000'),
(9, 5, '19.jpg', '18', 'STAN Counter Stool Hitam - Heim Studio', 1, 0, '1399000'),
(10, 5, '11.jpg', '18', 'Daito Sofabed - Heim Studio', 1, 0, '3499000'),
(11, 5, '21.jpg', '18', 'YVER KItchen Cupboard H180 - Heim Studio', 1, 20, '3199200'),
(12, 6, '23.jpg', '22', 'Maru Floor Cushion - Linori', 1, 0, '32900'),
(13, 6, '10.jpg', '22', 'Lampu Gantung SCP-6204-190 BK - Supra', 1, 0, '295000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `detail_produk` text NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `img` varchar(50) NOT NULL,
  `tersedia` varchar(15) NOT NULL,
  `harga_produk` int(15) NOT NULL,
  `diskon` int(15) NOT NULL,
  `stok_produk` int(15) NOT NULL,
  `rilis_produk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `detail_produk`, `id_kategori`, `img`, `tersedia`, `harga_produk`, `diskon`, `stok_produk`, `rilis_produk`) VALUES
(1, 'Arthome Set 7 Pcs - Informa', 'As a complement to a minimalist, modern, even Scandinavian style room decoration, you can use a set of wall hangings from Informa. This decoration can also be used as a photo frame if you want to change the look from time to time. This set includes a wall clock that has a unique design such as the sun and light bias which is interpreted in a minimalist style and black color. Apart from personal use, it can also be used as a gift idea.', 4, '1.jpg', 'Tidak', 393900, 0, 100, '2021-11-16'),
(2, 'Jack Sofa 2 Dudukan - Ifurnholic', 'The 2-Seat Sofa Jack has:\n<br>\n1.The armrests fit and are comfortable when sitting\n<br>\n2. Minimalist and neat design makes you relax when you sit\n<br>\n3. High elastic foam and dense structure make the sofa more comfortable to sit on\n<br>\n4. Equipped with a zig zag spring mounted flat as a reinforcement and adds to the comfort of the sofa\n<br>\n5. Mahogany legs are supported by iron to make them sturdy', 1, '2.jpg', 'Tidak', 4075000, 30, 100, '2021-11-16'),
(3, 'Touya Bed Frame Queen - Heim Studio', 'A bed with Japanese-Scandinavian design, made of quality solid wood and covered with woven fabric. Available in single, queen and king sizes. Suitable for mattress size 160x200.', 2, '3.jpg', 'Ada', 4999000, 10, 100, '2021-11-16'),
(4, 'Lemari Pakaian 3 Pintu - Olympic', 'Superiority :\n<br>\n1. Minimalist design\n<br>\n2. There is a large glass\n<br>\n3. Spacious storage area & drawers\n<br>\n4. Chrome iron hanger', 3, '4.jpg', 'Ada', 2600000, 0, 100, '2021-11-16'),
(5, 'Hera Karpet Motif ', 'Nylon printing motif carpet with a beautiful design that can beautify your room. Available in two sizes: 150x100cm and 200x150cm. So that it can adjust to the area of the room. * With material made of nylon thread, so it is more durable and has been cleaned * There are other pattern options available to suit the room layout * Anti-slip backing, so the carpet is not slippery and does not shift easily', 4, '6.jpg', 'Ada', 569000, 0, 100, '2021-11-16'),
(6, 'Lobo Mini Bean Bag - Linori', 'Lobo Mini Bean Bag ini adalah Bean bag multifungsi, mini bean bag yang cocok digunakan untuk bersantai ataupun bekerja di lantai (di depan coffee table, atau meja lesehan). Dengan isian foam beads, menjadikan mini bean bag ini lebih enteng. Dilengkapi dengan zipper sehingga memudahkan anda untuk mengisi kembali atau mengganti foam beads dan loop handle pada bagian belakang mini bean bag, sehingga memudahkan anda memindahkan posisi nya', 1, '7.jpg', 'Tidak', 399000, 0, 100, '2021-11-16'),
(7, 'Helsinki Single Bed 120 - Ifurnholic', 'In the past, you would often put boxes under the mattress, now there is HELSINKI SINGLE BED 120!! A mattress with a secret storage 1. Has 3 wooden drawers with quality (Heavy Duty) rails on one side (Suitable for storing bed linen, blankets, etc.).\n<br>\nExcess :\n1. The design is minimalist and aesthetic! Easy to combine with other furniture.\n<br>\n2. THERE IS A SECRET WAREHOUSE, items that are rarely used can be placed in storage at the bottom of the mattress.\n<br>\n3. MDF material with duco paint finish is more durable (more sturdy)\n<br>\n4. Looking for a safe cot for children? Our divan design has a rounded edge (blunt elbow).', 2, '8.jpg', 'Tidak', 3600000, 0, 100, '2021-11-16'),
(8, 'Helsinki Shoe Cabinet - Ifurnholic', 'Need a large shoe rack?\n<br>\nWhich can fit a lot of stuff?\n<br>\nLooking for multifunctional shelves to store all items?\n<br>\nHelsinki Shoe Cabinet is the solution, because\n<br>\n1. It has 4 shelves with 5 storage rooms that can be adjusted in height\n<br>\n2. The door is combined with wood grain to add a natural impression\n<br>\n3. Equipped with magnetic locks and quality hinges to make it easy to open the lid\n<br>\n4. There are holes to avoid the smell of shoes\n<br>\n5. The legs are equipped with adjusters so as not to damage the floor', 3, '9.jpg', 'Tidak', 2200000, 0, 100, '2021-11-16'),
(9, 'Lampu Gantung SCP-6204-190 BK - Supra', 'You don\'t need to present too many decorations so that the room looks more attractive. pendant lamp with an attractive design that can beautify your home.\n<br>\n- SCP-6204-190 BK\'s chandelier\n- Total Diameter: 19cm, Height 38cm, Length of hanging cable +/- 90cm\n<br>\nLamp : 1 x E.27 (Bulb not included)', 4, '10.jpg', 'Ada', 295000, 0, 100, '2021-11-16'),
(10, 'Daito Sofabed - Heim Studio', 'One of the best collections from Mebellic, Daito Sofabed, is here to beautify the spaces in your home. You can place the Daito Sofabed in spaces such as your living room, family room, or entertainment room. With an armrest feature that can be used as a place to put your drink, this sofa bed is very comfortable to use to enjoy your favorite movies.\nThis Japandi (Japanese Scandinavian) style sofa has a color that can be matched with various colors of your furniture. Besides having a very attractive color, this sofa is also designed for all kinds of shapes of your room, from a narrow room to a large one\nCombine this sofa with your other furniture such as a coffee table, side table, or tv table, we are sure it will make you always #SoWantPulang', 1, '11.jpg', 'Ada', 3499000, 0, 100, '2021-11-17'),
(11, 'Tempat Tidur Bed Sunny Single - Livien', 'Sunny Bed is the latest livien product by emphasizing its multifunctional side while still maintaining a very attractive design. A bed equipped with lots of storage drawers is suitable for a minimalist bedroom to keep it looking spacious. Not only that, the specialty of this bed is that there are drawers that can be used as study tables without having to move around, so it is very suitable for students and workers who often work with gadgets and books to make them more comfortable studying and working.\n<br>\nSuitable for mattress size 120x200x20cm.\n<br>\nThe maximum mattress height is 20 cm, more than that the table cannot be opened and closed.\n<br>\nCan withstand a maximum load of 90-95 kg for 2 adults.', 2, '12.jpg', 'Ada', 3575000, 0, 100, '2021-11-17'),
(12, 'Mako Rak Buku Sliding - Heim Studio', 'MAKO Sliding Bookshelf is a storage solution for your stationery and other products. Designed to make it easier to reach items within arm\'s reach, this shelf has eight shelves that you can adjust, on the front shelf you can slide left and right. for storage of various books and various knick-knacks that you want to display. Besides being useful for storing various files or as a display cabinet in your room, you can also place this bookshelf in the living room or it can also be used as a product display for commercial purposes.', 3, '13.jpg', 'Tidak', 1700000, 0, 100, '2021-11-17'),
(13, 'Cermin Kotak White Story - Livien', 'A square mirror with a frame made from solid wood, offers a natural and elegant atmosphere in your home space.', 4, '14.jpg', 'Ada', 679300, 0, 100, '2021-11-17'),
(14, 'Bean Bag Ain-P - Informa', 'Creating a relaxed holiday atmosphere at home is now easier with bean bags from Informa. You can put this bean bag in the living room, garden or private room. Made of strong and durable polyester. It can also be used for commercial needs or recreational arenas in the office.', 1, '15.jpg', 'Ada', 1199000, 0, 100, '2021-11-17'),
(15, 'Aloe Ortho Kasur Dengan Bantal & Guling - Informa', 'Realize more optimal rest time after all day activities with Ortho mattresses from Informa. This 160 x 200 cm queen bed can support your body optimally. Equipped with a high-tech spring structure to provide even pressure and provide maximum support for the health of your body\'s anatomy, from the neck, back, coccyx, to the legs. The combination of fabric made from natural aloe vera material with a layer of cooling gel memory foam makes this mattress feel cooler, safe for the skin, free of microbes, and able to absorb moisture so that it is comfortable on the skin. In addition, the surface is also equipped with a layer of green tea memory foam from green tea infused into the memory foam, so that it can follow the curves of the body, with a more refreshing aroma. The right mattress solution for your family\'s needs.', 2, '16.jpg', 'Tidak', 7379400, 0, 100, '2021-11-17'),
(16, 'Lemari Cody - Xavier Home Decor', 'Xavier Home Decor now comes with a CODY wardrobe. Designed with minimalism but still functional. For those of you who have limited space, you can make CODY a multipurpose wardrobe in your home. CODY, which is equipped with a full body mirror, can also be used to store clothes, hang clothes, look in the mirror, and also store shoes on the bottom shelf.', 3, '17.jpg', 'Tidak', 1495000, 0, 100, '2021-11-17'),
(17, 'Set Piring Makan / Dinner Plate - Java', 'Premium Cutlery from Java Porcelain. Made from thick and sturdy premium porcelain/ glassware. Black Base Color with Matt/Doff Finishing. Ideal for restaurant / bistro / cafe.\n<br>\nProduct Specifications:\n<br>\n- 22 cm diameter plate\n<br>\n- Price for 1 plate\n<br>\nAll Java Porcelain Collections: 100% Original and SNI. Proudly Indonesian Made in Indonesia.', 4, '18.jpg', 'Tidak', 99000, 0, 100, '2021-11-17'),
(18, 'STAN Counter Stool Hitam - Heim Studio', 'Booth Counter Stool Design :\n<br>\n1. Modern Japan\n<br>\n2. Stylish design available in 2 colors; black and white\n<br>\nFunction :\n<br>\n1. Counterstool chairs are suitable for tall dining tables but can also be used with standard height dining tables\n<br>\n2. With comfortable foam pads', 1, '19.jpg', 'Ada', 1399000, 0, 100, '2021-11-17'),
(19, 'Laurent Bed Frame Single Drawer King - Ananta', 'A bed with a scandinavian design made of solid wood and upholstered in luxurious suede. With two drawers, (one drawer on each side with a width of 142 cm with a maximum recommended weight of 15kg) that can be used as a place to store clothes or bed linen. Available in single, queen and king sizes.\nHeadboard size 180x10x140, Divan size 180x200x40, Drawer size 137x42x15.\nSuitable for a 180x200 mattress and a mattress height of 25-27cm.', 2, '20.jpg', 'Ada', 6720000, 0, 100, '2021-11-17'),
(20, 'YVER KItchen Cupboard H180 - Heim Studio', 'As a storage area in the kitchen, it can be paired with other yver series, but it\'s still easy to mix and match to fill the kitchen. The bottom is easy to clean', 3, '21.jpg', 'Tidak', 3999000, 20, 100, '2021-11-17'),
(21, 'Liberty Sofa Tidur Fabric - Informa', 'Relaxing in the living room or family room can be realized by having this Liberty sofa bed offered by Informa. This sofa has an ergonomic design, because it can be used to sit as well as to lie down. You just change the shape as needed. Made of quality material, this sofa bed is sturdy so it is more durable and long lasting.', 1, '22.jpg', 'Ada', 5999000, 0, 100, '2021-11-17'),
(22, 'Maru Floor Cushion - Linori', 'Maru Floor cushion with a thickness of 24cm which makes sitting more soft. The width of the floor cushion is 50x50cm which makes it more comfortable to sit on. Multifunctional, can be used to sit on the floor while working in front of a coffee table and to just sit and relax. Filled with foam beads, this maru floor cushion is not heavy and more durable. Equipped with a zipper, making it easier for you to refill or replace the foam beads.', 1, '23.jpg', 'Ada', 32900, 0, 100, '2021-11-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `email`, `username`, `alamat`, `no_telp`, `password`, `gambar`) VALUES
(1, 'bintangrrr71@gmail.com', 'bintang71', 'Sukaraya Regensi Blok F-18', '85775723618', '$2y$10$Afj7Di6ZQotdSIn73SOBEesh93ElIU6pQZYGk291j/OWPWv0rQDbK', ''),
(2, 'farisnvl@gmail.com', 'faris', '', '85775723618', '$2y$10$fmdJkqQ3U155w.A0j9wnpu1IHJsMoZQ3TDbeSLcTF1kuzLXwvBs5K', ''),
(3, 'wira71@gmail.com', 'wira', 'Cikarang', '8572517822', '$2y$10$JYYzjRSK/g5ZVVbXAdoW3OiBxY2w7//iBajV1Os.NWF/imqIPH7w6', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `checkout`
--
ALTER TABLE `checkout`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
