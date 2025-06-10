import LilyBlouseImage1 from "../assets/images/products/lily-blouse-1.webp";
import LilyBlouseImage2 from "../assets/images/products/lily-blouse-2.webp";
import LilyBlouseImage3 from "../assets/images/products/lily-blouse-3.webp";
import LilyBlouseImage4 from "../assets/images/products/lily-blouse-4.webp";
import LilyBlouseDustyPink from "../assets/images/products/lily-blouse-dusty-pink.webp";
import LilyBlouseUnguLavender from "../assets/images/products/lily-blouse-ungu-lavender.webp";
import LilyBlouseBiruDenim from "../assets/images/products/lily-blouse-biru-denim.webp";
import LilyBlouseHijauTosca from "../assets/images/products/lily-blouse-hijau-tosca.webp";

import KiwoyoBros1 from "../assets/images/products/kiwoyo-bros-1.webp";
import KiwoyoBrosUngu from "../assets/images/products/kiwoyo-bros-ungu.webp";
import KiwoyoBrosPink from "../assets/images/products/kiwoyo-bros-pink.webp";
import KiwoyoBrosBiru from "../assets/images/products/kiwoyo-bros-biru.webp";
import KiwoyoBrosLayerBiru from "../assets/images/products/kiwoyo-bros-layer-biru.webp";
import KiwoyoBrosLayerPink from "../assets/images/products/kiwoyo-bros-layer-pink.webp";
import KiwoyoBrosPitaSilk from "../assets/images/products/kiwoyo-bros-pita-silk.webp";

const products = [
  {
    id: 1,
    name: "Lily Blouse | Blouse Korean Style | Blouse Lengan Panjang",
    slug: "lily-blouse-blouse-korean-style-blouse-lengan-panjang",
    size: ["XS", "S", "M", "L"],
    price: 90169,
    description: `<p>
      ‼️SEBELUM MEMBELI CHECK DESKRIPSI PRODUK TERLEBIH DAHULU☺️‼️
      <br />
      <br />
      🎀 New Product 🎀
      — Lily Blouse —
      <br />
      Bahan : Rayon Twill Premium
      Detail  : 
      - Karakteristik kain rayon twill premium yang bertekstur lembut, halus, dan menyerap keringat sehingga nyaman digunakan
      - Model Ruffle
      - Kerah, dan Berkancing
      - Pergelangan tangan memakai kancing
      - Ukuran : XS - L
      - Warna : Dusty Pink, Biru Denim, Hijau Tosca, Ungu Lavender
      <br />
      <br />
      Size : 
      <br />
      XS = 
      PB : 58
      PL : 52
      LD : 90
      <br />
      S =
      PB : 60
      PL : 55
      LD : 96
      <br />
      M =
      PB : 62
      PL : 57
      LD : 102
      <br />
      L =
      PB : 64
      PL : 57
      LD : 108
      <br />
      catatan = 
      PB  : Panjang Badan
      PL  : Panjang Lengan
      LD  : Lingkar Dada
      <br />
      <br />
      🌸 Buka Senin - Sabtu, Minggu Libur 🌸
      <br />
      <br />
      Happy Shopping ‼️🛒
    </p>`,
    categories: [{ name: "Atasan Muslim Wanita" }],
    images: [
      { thumbnail: true, image: LilyBlouseImage1 },
      { thumbnail: false, image: LilyBlouseImage2 },
      { thumbnail: false, image: LilyBlouseImage3 },
      { thumbnail: false, image: LilyBlouseImage4 },
    ],
    variants: [
      { color: "Dusty Pink", image: LilyBlouseDustyPink },
      {
        color: "Ungu Lavender",
        image: LilyBlouseUnguLavender,
      },
      { color: "Biru Denim", image: LilyBlouseBiruDenim },
      { color: "Hijau Tosca", image: LilyBlouseHijauTosca },
    ],
    created_at: "2025-06-10T11:00:00Z",
  },
  {
    id: 2,
    name: "KIWOYO Bros/Pin Pita Besar Dobel Layer Bahan Kain Gaya Fashion Korea",
    slug: "kiwoyo-bros-pin-pita-besar-dobel-layer-bahan-kain-gaya-fashion-korea",
    size: null,
    price: 10000,
    description: `<p>
      ‼️SEBELUM MEMBELI CHECK DESKRIPSI PRODUK TERLEBIH DAHULU‼️
      <br />
      <br />
      New Product
      — Kiwoyo Pita Aksesoris —
      <br />
      Bahan : Katun, Silk & Organza
      Detail  : 
      Gemes bangett bisa dijadiin bros kerudung, atau bisa ditaro dibelakang kerudung
      <br />
      Buka Senin - Sabtu, Minggu Libur
      <br />
      <br />
      Happy Shopping
    </p>`,
    categories: [{ name: "Aksesoris Tambahan" }],
    images: [{ thumbnail: true, image: KiwoyoBros1 }],
    variants: [
      { color: "Ungu", image: KiwoyoBrosUngu },
      { color: "Pink", image: KiwoyoBrosPink },
      { color: "Biru", image: KiwoyoBrosBiru },
      { color: "Satu Layer Biru", image: KiwoyoBrosLayerBiru },
      { color: "Satu Layer Pink", image: KiwoyoBrosLayerPink },
      { color: "Pita Silk", image: KiwoyoBrosPitaSilk },
    ],
    created_at: "2025-06-10T13:00:00Z",
  },
];

export default products;
