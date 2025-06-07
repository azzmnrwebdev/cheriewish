import thumb1 from "../assets/images/products/thumbnail-1.png";

const products = [
  {
    id: 1,
    name: "Kaos Polos",
    slug: "kaos-polos",
    size: ["M", "L", "XL"],
    price: 100000,
    description: `<p>Kaos polos bahan katun, nyaman dipakai.</p>`,
    thumbnail: thumb1,
    categories: [
      { id: 1, name: "Atasan" },
      { id: 2, name: "Casual" },
      { id: 3, name: "Pria" },
    ],
    variants: [
      { id: 1, color: "Merah", image: "../assets/images/products/dummy-1.png" },
      { id: 2, color: "Biru", image: "../assets/images/products/dummy-1.png" },
    ],
    created_at: "2025-06-06T10:00:00Z",
  },
  {
    id: 2,
    name: "Hoodie Zipper",
    slug: "hoodie-zipper",
    size: ["M", "L"],
    price: 100000,
    description: `<p>Hoodie dengan resleting depan, cocok untuk cuaca dingin.</p>`,
    thumbnail: thumb1,
    categories: [
      { id: 1, name: "Atasan" },
      { id: 4, name: "Musim Dingin" },
      { id: 5, name: "Unisex" },
    ],
    variants: [
      { id: 3, color: "Hitam", image: "../assets/images/products/dummy-1.png" },
      {
        id: 4,
        color: "Abu-Abu",
        image: "../assets/images/products/dummy-1.png",
      },
    ],
    created_at: "2025-06-05T14:30:00Z",
  },
  {
    id: 3,
    name: "Kemeja Lengan Panjang",
    slug: "kemeja-lengan-panjang",
    size: ["M"],
    price: 130000,
    description: `<p>Kemeja lengan panjang cocok untuk acara formal maupun kasual.</p>`,
    thumbnail: thumb1,
    categories: [
      { id: 1, name: "Atasan" },
      { id: 6, name: "Formal" },
      { id: 3, name: "Pria" },
    ],
    variants: [
      { id: 5, color: "Putih", image: "../assets/images/products/dummy-1.png" },
      {
        id: 6,
        color: "Biru Dongker",
        image: "../assets/images/products/dummy-1.png",
      },
    ],
    created_at: "2025-06-04T09:15:00Z",
  },
  {
    id: 4,
    name: "Rok Span",
    slug: "rok-span",
    size: ["L"],
    price: 90000,
    description: `<p>Rok span bahan stretch, nyaman untuk kerja atau kuliah.</p>`,
    thumbnail: thumb1,
    categories: [
      { id: 7, name: "Bawahan" },
      { id: 8, name: "Wanita" },
      { id: 6, name: "Formal" },
    ],
    variants: [
      { id: 7, color: "Hitam", image: "../assets/images/products/dummy-1.png" },
      {
        id: 8,
        color: "Coklat",
        image: "../assets/images/products/dummy-1.png",
      },
    ],
    created_at: "2025-06-03T11:45:00Z",
  },
  {
    id: 5,
    name: "Celana Jeans Slim Fit",
    slug: "celana-jeans-slim-fit",
    size: ["M", "L", "XL"],
    price: 150000,
    description: `<p>Celana jeans model slim fit, cocok untuk gaya kasual.</p>`,
    thumbnail: thumb1,
    categories: [
      { id: 7, name: "Bawahan" },
      { id: 2, name: "Casual" },
      { id: 3, name: "Pria" },
    ],
    variants: [
      {
        id: 9,
        color: "Biru Tua",
        image: "../assets/images/products/dummy-1.png",
      },
    ],
    created_at: "2025-06-02T10:20:00Z",
  },
  {
    id: 6,
    name: "Dress Floral",
    slug: "dress-floral",
    size: ["S", "M"],
    price: 175000,
    description: `<p>Dress motif bunga untuk tampilan feminin dan segar.</p>`,
    thumbnail: thumb1,
    categories: [
      { id: 8, name: "Wanita" },
      { id: 9, name: "Musim Panas" },
    ],
    variants: [
      {
        id: 10,
        color: "Merah Muda",
        image: "../assets/images/products/dummy-1.png",
      },
      {
        id: 11,
        color: "Putih",
        image: "../assets/images/products/dummy-1.png",
      },
    ],
    created_at: "2025-06-01T16:50:00Z",
  },
  {
    id: 7,
    name: "Sweater Rajut",
    slug: "sweater-rajut",
    size: ["L", "XL"],
    price: 120000,
    description: `<p>Sweater rajut yang hangat dan stylish untuk musim dingin.</p>`,
    thumbnail: thumb1,
    categories: [
      { id: 1, name: "Atasan" },
      { id: 4, name: "Musim Dingin" },
    ],
    variants: [
      { id: 12, color: "Krem", image: "../assets/images/products/dummy-1.png" },
    ],
    created_at: "2025-05-30T12:40:00Z",
  },
  {
    id: 8,
    name: "Blazer Formal",
    slug: "blazer-formal",
    size: ["M", "L"],
    price: 200000,
    description: `<p>Blazer cocok untuk tampilan profesional dan rapi.</p>`,
    thumbnail: thumb1,
    categories: [
      { id: 1, name: "Atasan" },
      { id: 6, name: "Formal" },
    ],
    variants: [
      {
        id: 13,
        color: "Hitam",
        image: "../assets/images/products/dummy-1.png",
      },
      { id: 14, color: "Navy", image: "../assets/images/products/dummy-1.png" },
      {
        id: 15,
        color: "Abu-Abu",
        image: "../assets/images/products/dummy-1.png",
      },
    ],
    created_at: "2025-05-29T09:00:00Z",
  },
  {
    id: 9,
    name: "Kaos Graphic Tee",
    slug: "kaos-graphic-tee",
    size: ["M", "L", "XL"],
    price: 110000,
    description: `<p>Kaos dengan desain grafis unik, cocok untuk anak muda.</p>`,
    thumbnail: thumb1,
    categories: [
      { id: 1, name: "Atasan" },
      { id: 2, name: "Casual" },
    ],
    variants: [
      {
        id: 16,
        color: "Putih",
        image: "../assets/images/products/dummy-1.png",
      },
      {
        id: 17,
        color: "Hitam",
        image: "../assets/images/products/dummy-1.png",
      },
    ],
    created_at: "2025-05-28T11:15:00Z",
  },
  {
    id: 10,
    name: "Celana Chino",
    slug: "celana-chino",
    size: ["L", "XL"],
    price: 140000,
    description: `<p>Celana chino yang nyaman dan fleksibel untuk berbagai suasana.</p>`,
    thumbnail: thumb1,
    categories: [
      { id: 7, name: "Bawahan" },
      { id: 3, name: "Pria" },
    ],
    variants: [
      {
        id: 18,
        color: "Khaki",
        image: "../assets/images/products/dummy-1.png",
      },
      {
        id: 19,
        color: "Abu-Abu",
        image: "../assets/images/products/dummy-1.png",
      },
    ],
    created_at: "2025-05-27T08:00:00Z",
  },
];

export default products;
