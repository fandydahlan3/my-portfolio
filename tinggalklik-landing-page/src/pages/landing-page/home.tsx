import './styles/home.css'
import { Card, Image, Table } from 'react-bootstrap'
import categoryImages from '../../assets/category-images/category-images'
import cardImages from '../../assets/card-images/card-images'

const home = () => {
    return (
        <>
            <Table>
                <thead className="text-center container">
                    <tr>
                        <img src="src\assets\react.svg" className="img-thumbnail" alt="..." />
                    </tr>
                    <tr>
                        <h2 className='text-center mt-2'><span>Tinggalklik</span> - Platform Social Networking</h2>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <p className='text-center mx-4 container'>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>
                    </tr>
                    <tr className='d-flex justify-content-center gap-2'>
                        <a href="http://" target="_blank" rel="noopener noreferrer">
                            <Image src="src\assets\appstore.png" width={'120'} />
                        </a>
                        <a href="http://" target="_blank" rel="noopener noreferrer">
                            <Image src="src\assets\appstore.png" width={'120'} />
                        </a>
                    </tr>
                    <tr>
                        <div className='home-bottom mt-4 p-5'>
                            <h5 className='text-white mb-4'>Activities</h5>
                            <div className='d-flex justify-content-center gap-2'>
                                {categoryImages.map((image, index) => (
                                    <div key={index}>
                                        <img src={image.path} alt={image.name} width={70} />
                                    </div>
                                ))}
                            </div>
                        </div>
                    </tr>
                    <tr>
                        <table className='my-2 container'>
                            <thead>
                                <tr>
                                    <h5 className='text-center mt-4'>How it Work?</h5>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <div className='d-flex justify-content-center gap-3 home-card'>
                                        {cardImages.map((card, index) =>
                                            <Card key={index} style={{ width: '14rem' }} className='border-2 shadow-sm'>
                                                <Card.Img variant="top" className='pt-3' src={card.path} width={40}/>
                                                <Card.Body>
                                                    <Card.Title>{card.tittle}</Card.Title>
                                                    <Card.Text>
                                                        {card.text}
                                                    </Card.Text>
                                                </Card.Body>
                                            </Card>
                                        )}
                                    </div>
                                </tr>
                            </tbody>
                        </table>
                    </tr>
                </tbody>
            </Table>
        </>
    )
}

export default home