import { useParams } from "react-router-dom";

const Product = () => {
  const { slug } = useParams();

  return (
    <div>
      <h1>Product {slug}</h1>
    </div>
  );
};

export default Product;
