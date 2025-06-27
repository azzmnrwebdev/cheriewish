import "../../assets/css/gallery.css";
import { Container } from "react-bootstrap";
import galeries from "../../utils/galeries";
import { useEffect, useState } from "react";

const Gallery = () => {
  const [shuffledData, setShuffledData] = useState([]);

  const shuffleArray = (array) => {
    const newArray = [...array];
    for (let i = newArray.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [newArray[i], newArray[j]] = [newArray[j], newArray[i]];
    }
    return newArray;
  };

  useEffect(() => {
    setShuffledData(shuffleArray(galeries));
  }, []);

  return (
    <section id="gallery">
      <Container>
        <div className="d-flex flex-column justify-content-center align-items-center mt-5">
          <h1 className="fw-bold title text-dark">
            Gallery <span style={{ color: "#f5596c" }}>Cheriewish</span>
          </h1>

          <p className="mb-0 sub-title text-body px-3 px-sm-5">
            Tempat mengabadikan momen berharga dari setiap produk yang kami
            jual. Lihat keseruan saat berjualan dan kebahagiaan pelanggan
            setelah membeli produk Cheriewish. Jadilah bagian dari perjalanan
            kami dan rasakan kepuasan yang sama!
          </p>
        </div>

        {/* Content */}
        <div className="card-columns mt-5 mb-4">
          {shuffledData.map((item, index) => (
            <div key={index} className="card border-0 rounded-0 bg-transparent">
              <div className="card-body p-0">
                {item.type === "foto" ? (
                  <img
                    src={item.path}
                    alt="Foto"
                    className="img-fluid object-fit-cover rounded-3"
                  />
                ) : null}
              </div>
            </div>
          ))}
        </div>
      </Container>
    </section>
  );
};

export default Gallery;
