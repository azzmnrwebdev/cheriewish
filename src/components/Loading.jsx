import "../assets/css/loading.css";
import { useState, useEffect } from "react";
import { useLocation } from "react-router-dom";

const LoadingScreen = () => {
  const location = useLocation();
  const [isFading, setIsFading] = useState(false);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    setIsLoading(true);
    setIsFading(false);

    const timer = setTimeout(() => {
      setIsFading(true);
      setTimeout(() => setIsLoading(false), 500);
    }, 500);

    return () => clearTimeout(timer);
  }, [location.key]);

  if (!isLoading) return null;

  return (
    <div className={`loading-screen ${isFading ? "fade-out" : ""}`}>
      <div className="loader"></div>
    </div>
  );
};

export default LoadingScreen;
