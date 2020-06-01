import React, { useState, useEffect, Fragment } from 'react'
import ReactDOM from 'react-dom'
import Axios from 'axios'
import ContentLoader from 'react-content-loader'


const Cart = () => {
    const [datas, setDatas] = useState([])
    const [totalPrice, setTotalPrice] = useState('')  
    const [loading, setLoading] = useState(true)  


    const handleChange = async ({ currentTarget }) => {
        const { dataset, value } = currentTarget

        await Axios
            .post('/panier/setAmount/' + dataset.item + '/' + value)
            .then(() => {
                let copy = datas.slice()

                if (parseInt(value) === 0) {
                    copy.splice(dataset.id, 1)
                    setDatas(copy || [])
                } else {
                    copy[dataset.id].amount = parseInt(value)
                    setDatas(copy)
                }
                setFullPrice(copy)
            })
        }
        
    const fetch = async () => {
        await Axios.get('https://localhost:8000/api/users/1')
        .then((response) => {
            setDatas(response.data.carts[0].items)
            setFullPrice(response.data.carts[0].items)
            setLoading(false)
        })

    }

    const setFullPrice = (entry) => {
        let price = 0
        entry.forEach((object) => {
            price += (object.amount * object.item.price)
        })
        setTotalPrice(price)
    }

    useEffect(() => {
        fetch()
    }, [])
    return (
        <section className="page-section" id="products">
            <div className="container">
                <div className="text-center">
                    <h3 className="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div className="row">
                <table className="table">
                    <thead>
                        <tr>
                            <th scope="col">Produit</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    {datas && (
                    <tbody>
                        {datas.map((element, key) => {
                            return(
                                <tr key={key}>
                                    <td>
                                        <a href={`/produits/${element.item.category.slug}/${element.item.slug}/${element.item.id}`}>{ element.item.label }</a>
                                    </td>
                                    <td>{ element.item.price } €</td>
                                    <td>
                                        <input type="number" defaultValue={ element.amount } data-id={key} data-item={ element.id } className="amount" onChange={handleChange} />
                                    </td>
                                    <td>{ element.item.price * element.amount } €</td>
                                    <td className="text-right">
                                        <a href="" className="btn btn-danger btn-sm">
                                            <i className="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            )
                        })}
                    </tbody>
                    )}
                    {!loading && (
                    <tfoot>
                        <tr>
                            <td colSpan="3" className="text-right">Total :</td>
                            <td>{totalPrice} €</td>
                            <td></td>
                        </tr>
                    </tfoot>
                    )}
                </table>
                {loading && (
                    <Fragment>
                        <ContentLoader speed={0.5} width={1500} height={30} viewBox="0 0 1400 20" backgroundColor="#f3f3f3" foregroundColor="#ecebeb">
                            <rect x="0" y="0" rx="10" ry="10" width="250" height="20" />
                            <rect x="260" y="0" rx="10" ry="10" width="250" height="20" />
                            <rect x="520" y="0" rx="10" ry="10" width="300" height="20" />
                            <rect x="830" y="0" rx="10" ry="10" width="560" height="20" />
                        </ContentLoader>
                        <ContentLoader speed={0.5} width={1500} height={30} viewBox="0 0 1400 20" backgroundColor="#f3f3f3" foregroundColor="#ecebeb">
                            <rect x="0" y="0" rx="10" ry="10" width="150" height="20" />
                            <rect x="160" y="0" rx="10" ry="10" width="320" height="20" />
                            <rect x="490" y="0" rx="10" ry="10" width="250" height="20" />
                            <rect x="750" y="0" rx="10" ry="10" width="300" height="20" />
                            <rect x="1200" y="0" rx="10" ry="10" width="250" height="20" />
                        </ContentLoader>
                        <ContentLoader speed={0.5} width={1500} height={30} viewBox="0 0 1400 20" backgroundColor="#f3f3f3" foregroundColor="#ecebeb">
                            <rect x="0" y="0" rx="10" ry="10" width="150" height="20" />
                            <rect x="160" y="0" rx="10" ry="10" width="320" height="20" />
                            <rect x="490" y="0" rx="10" ry="10" width="250" height="20" />
                            <rect x="750" y="0" rx="10" ry="10" width="200" height="20" />
                            <rect x="1000" y="0" rx="10" ry="10" width="450" height="20" />
                        </ContentLoader>
                        <ContentLoader speed={0.5} width={1500} height={30} viewBox="0 0 1400 20" backgroundColor="#f3f3f3" foregroundColor="#ecebeb">
                            <rect x="0" y="0" rx="10" ry="10" width="250" height="20" />
                            <rect x="260" y="0" rx="10" ry="10" width="300" height="20" />
                        </ContentLoader>
                        
                    </Fragment>
                )}                       
                </div>
            </div>
        </section>
    )
}

ReactDOM.render(<Cart />, document.querySelector('#cart-component'))