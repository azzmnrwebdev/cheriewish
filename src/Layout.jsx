import "aos/dist/aos.css";
import "./assets/css/index.css";
import { Outlet } from "react-router-dom";
import NavbarComponent from "./components/Navbar";
import FooterComponent from "./components/Footer";
import { useEffect } from "react";
import Aos from "aos";

const Layout = () => {
  useEffect(() => {
    Aos.init({
      duration: 1000,
      easing: "ease-in-out",
    });
  }, []);

  return (
    <>
      <NavbarComponent />
      <Outlet />
      <FooterComponent />
    </>
  );
};

export default Layout;
