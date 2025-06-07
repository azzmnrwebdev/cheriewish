import "../../assets/css/gallery.css";
import { Container } from "react-bootstrap";
import Image from "../../assets/images/web-builder.png";

const Gallery = () => {
  return (
    <section id="gallery">
      <Container>
        <div className="row align-items-center g-0 g-md-4">
          <div className="col-12 col-md-6 order-md-1 mb-4 mb-md-0 d-flex justify-content-center">
            <img src={Image} alt="Image" />
          </div>

          <div className="col-12 col-md-6">
            <h1 className="title mb-3">Coming Soon: Galeri Cheriewish</h1>
            <p className="mb-0 description lh-lg">
              Halaman galeri ini sedang dalam tahap pengembangan. Lihat
              dokumentasi foto dan video kami segera di sini. Sementara itu,
              kamu bisa pantau update terbaru melalui Instagram{" "}
              <a
                href="https://www.instagram.com/cheriewish.id?igsh=MTNtMXYyaTBhcm02Yg=="
                target="_blank"
                className="text-decoration-none fw-semibold"
                style={{ color: "#f5596c" }}
              >
                @cheriewish
              </a>
              .
            </p>
          </div>
        </div>
      </Container>
    </section>
  );
};

export default Gallery;
