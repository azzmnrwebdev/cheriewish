import "./assets/css/index.css";
import { useEffect } from "react";
import LoadingScreen from "./components/Loading";
import NavbarComponent from "./components/Navbar";
import FooterComponent from "./components/Footer";
import { Outlet, useLocation } from "react-router-dom";
import backgroundImage from "./assets/images/background2.png";

const Layout = () => {
  const { pathname } = useLocation();

  useEffect(() => {
    window.scrollTo(0, 0);

    const isCatalogPage = /^\/catalog\/?$/.test(pathname);
    const isProductPage = /\/catalog\/[^/]+/.test(pathname);

    if (isCatalogPage || isProductPage) {
      document.body.style.backgroundSize = "cover";
      document.body.style.backgroundRepeat = "no-repeat";
      document.body.style.backgroundPosition = "top center";
      document.body.style.backgroundImage = `url(${backgroundImage})`;
    } else {
      document.body.style.backgroundImage = "";
      document.body.style.backgroundSize = "";
      document.body.style.backgroundRepeat = "";
      document.body.style.backgroundPosition = "";
    }

    return () => {
      document.body.style.backgroundImage = "";
      document.body.style.backgroundSize = "";
      document.body.style.backgroundRepeat = "";
      document.body.style.backgroundPosition = "";
    };
  }, [pathname]);

  return (
    <>
      <LoadingScreen />
      <NavbarComponent />
      <Outlet />
      <FooterComponent />
    </>
  );
};

export default Layout;
