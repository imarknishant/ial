
// Using the React Context API, let's store the state of our entire app
const TipJarWPStateContext = React.createContext();

class TipJarWPStateContextProvider extends React.Component {

	constructor( props ){
		super(props);
		this.state = {}
	}

	render() {
		return (
			<TipJarWPStateContext.Provider
			value={{
				state: this.state,
				update_state: ( new_state ) => {

					return new Promise( (resolve, reject) => {

						// If the state was not updated after 1 second, reject the promise
						const timeout = setTimeout( () => {
							reject(Error("Unable to update state"));
						}, 1000 );

						// Update the state, then resolve the promise
						this.setState( new_state, function() {
							clearTimeout( timeout );
							resolve( this.state );
						} );

					});
				}
			}}
			>
			{ this.props.children }
			</TipJarWPStateContext.Provider>
		)
	}
}
export { TipJarWPStateContext, TipJarWPStateContextProvider }
