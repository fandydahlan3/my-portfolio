import { Navbar, Container, Nav, Button } from 'react-bootstrap';
import logo from '../../assets/react.svg';

const navbar = () => {
    return (
        <Navbar sticky="top" expand="lg" bg="body" variant="tertiary" className="shadow-sm p-3 mb-5 bg-body rounded">
            <Container>
                <Navbar.Brand href="#">
                    <img src={logo} alt="Logo" width="30" height="24" className="d-inline-block align-text-top" />
                </Navbar.Brand>
                <Navbar.Toggle aria-controls="navbarScroll" />
                <Navbar.Collapse id="navbarScroll">
                    <Nav className="me-auto my-2 my-lg-0 navbar-nav-scroll">
                        <Nav.Item>
                            <Nav.Link href="#" active>Feature</Nav.Link>
                        </Nav.Item>
                        <Nav.Item>
                            <Nav.Link href="#">Article</Nav.Link>
                        </Nav.Item>
                        <Nav.Item>
                            <Nav.Link href="#">About Us</Nav.Link>
                        </Nav.Item>
                    </Nav>
                    <Button variant="outline-success" className="rounded-pill">Search</Button>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    )
}

export default navbar;
